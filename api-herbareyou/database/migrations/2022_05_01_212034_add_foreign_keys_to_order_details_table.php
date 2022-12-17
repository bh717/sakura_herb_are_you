<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign('order_id', 'order_details_order_id_fk')->references('id')->on('orders')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_category_id', 'order_details_product_category_id_fk')->references('id')->on('product_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id', 'order_details_product_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_price_id', 'order_details_product_price_id_fk')->references('id')->on('product_prices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('order_details_order_id_fk');
            $table->dropForeign('order_details_product_category_id_fk');
            $table->dropForeign('order_details_product_id_fk');
            $table->dropForeign('order_details_product_price_id_fk');
        });
    }
}
