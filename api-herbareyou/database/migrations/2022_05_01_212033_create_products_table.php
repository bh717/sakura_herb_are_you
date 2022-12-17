<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('product_category_id')->index('product_category_id')->comment('商品カテゴリid');
            $table->string('product_no', 10)->comment('商品no');
            $table->string('name1')->comment('商品名1');
            $table->string('name2')->comment('商品名2');
            $table->integer('capacity')->default(0)->comment('内容量');
            $table->string('description', 1000)->comment('商品説明');
            $table->boolean('is_public')->nullable()->default(1)->comment('公開');
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
        Schema::drop('products');
    }
}
