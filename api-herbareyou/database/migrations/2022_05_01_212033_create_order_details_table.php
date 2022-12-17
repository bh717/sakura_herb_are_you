<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('order_id')->index('order_id')->comment('注文id');
            $table->bigInteger('product_category_id')->index('product_category_id')->comment('商品カテゴリid');
            $table->bigInteger('product_id')->index('product_id')->comment('商品id');
            $table->bigInteger('product_price_id')->index('product_price_id')->comment('商品値段id');
            $table->string('product_category_name')->comment('名前');
            $table->string('product_category_series_name')->comment('シリーズ名');
            $table->string('product_no', 10)->comment('商品no');
            $table->string('product_name1')->comment('商品名1');
            $table->string('product_name2')->comment('商品名2');
            $table->string('product_description', 1000)->comment('商品説明');
            $table->integer('product_price')->default(0)->comment('商品値段(税込み価格)');
            $table->integer('product_include_tax')->default(0)->comment('内消費税');
            $table->string('product_capacity')->comment('商品値段容量');
            $table->string('symptom_id_csv')->default('')->comment('症状id_csv');
            $table->string('taste_id_csv')->default('')->comment('味id_csv');
            $table->string('material_id_csv')->default('')->comment('材料id_csv');
            $table->string('symptom_name_csv')->default('')->comment('症状name_csv');
            $table->string('taste_name_csv')->default('')->comment('味name_csv');
            $table->string('material_name_csv')->default('')->comment('材料name_csv');
            $table->integer('num')->comment('購入数');
            $table->integer('sub_total')->default(0)->comment('小計');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_details');
    }
}
