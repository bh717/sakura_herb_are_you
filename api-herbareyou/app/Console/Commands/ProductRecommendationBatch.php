<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\ProductPopularation;
use DB;
use Illuminate\Console\Command;

class ProductRecommendationBatch extends Command
{
    protected $signature = 'batch:ProductRecommendationBatch';
    protected $description = '人気の商品を更新します';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        logs()->info('人気の商品を更新バッチ開始');

        // 購入された商品数に並び替えて取得
        $productPopularations = ProductPopularation::getOrderByBuyCount();
        // 購入されなかった商品をランダムに取得
        $products = Product::whereNotIn('id', $productPopularations->pluck('product_id')->toArray())
            ->select(['id'])
            ->get()
            ->shuffle();
        DB::beginTransaction();
        try {
            ProductPopularation::query()->delete();
            // 購入分
            foreach ($productPopularations as $productPopularation) {
                $newProductPopularation = new ProductPopularation();
                $newProductPopularation->product_id = $productPopularation->product_id;
                $newProductPopularation->count = $productPopularation->count;
                $newProductPopularation->saveOrFail();
            }
            // 購入されていない分
            foreach ($products as $product) {
                $newProductPopularation = new ProductPopularation();
                $newProductPopularation->product_id = $product->id;
                $newProductPopularation->count = 0;
                $newProductPopularation->saveOrFail();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            logs()->error($th);
            dd($th);
        }

        logs()->info('人気の商品を更新バッチ終了');
    }
}
