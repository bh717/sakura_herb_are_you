<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('coupon_id', 'orders_coupon_id_fk')->references('id')->on('coupons')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('user_delivery_location_id', 'orders_user_delivery_location_id_fk')->references('id')->on('user_delivery_locations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('user_id', 'orders_user_id_fk')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_coupon_id_fk');
            $table->dropForeign('orders_user_delivery_location_id_fk');
            $table->dropForeign('orders_user_id_fk');
        });
    }
}
