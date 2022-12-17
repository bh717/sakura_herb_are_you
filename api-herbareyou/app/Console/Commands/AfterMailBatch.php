<?php

namespace App\Console\Commands;

use App\Enums\ProductRecommendationKind;
use App\Mail\User\OrderAfterMail;
use App\Models\Order;
use App\Models\Product;
use DB;
use Illuminate\Console\Command;
use Mail;

class AfterMailBatch extends Command
{
    protected $signature = 'batch:afterMail';
    protected $description = 'アフターメールを送信します';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        logs()->info('アフターメールを送信バッチ開始');

        $orders = Order::with(['user'])
            ->whereAfterMail()
            ->get();
        if ($orders->isEmpty()) {
            logs()->info('アフターメール終了');
            return;
        }
        $recommendationProducts = Product::getRecommendationProducts(
            ProductRecommendationKind::SEASONAL_RECOMMENDATIONS
        );
        foreach ($orders as $order) {
            DB::beginTransaction();
            try {
                $order->updateToAfterMail();
                Mail::to($order->user)->send(new OrderAfterMail($order->user, $recommendationProducts));
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                logs()->error($th);
            }
        }

        logs()->info('アフターメールを送信バッチ修了');
    }
}
