<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('order_no', 32)->nullable()->comment('注文no');
            $table->bigInteger('user_id')->index('user_id')->comment('購入者id');
            $table->bigInteger('user_delivery_location_id')->index('user_delivery_location_id')->comment('お届け先');
            $table->bigInteger('coupon_id')->nullable()->index('coupon_id')->comment('クーポンid');
            $table->string('user_email')->nullable()->comment('購入者メールアドレス');
            $table->string('user_last_name')->nullable()->comment('購入者名字');
            $table->string('user_first_name')->nullable()->comment('購入者名前');
            $table->string('user_last_name_kana')->nullable()->comment('購入者名字カナ');
            $table->string('user_first_name_kana')->nullable()->comment('購入者名前カナ');
            $table->date('user_birthday')->nullable()->comment('購入者生年月日');
            $table->string('user_zip', 20)->nullable()->comment('購入者郵便番号');
            $table->string('user_address1')->nullable()->comment('購入者住所1');
            $table->string('user_tel1', 20)->nullable()->comment('購入者電話番号');
            $table->string('user_delivery_location_email', 256)->comment('お届け先 メールアドレス');
            $table->string('user_delivery_location_last_name', 256)->comment('お届け先 名字');
            $table->string('user_delivery_location_first_name', 256)->comment('お届け先 名前');
            $table->string('user_delivery_location_last_name_kana', 256)->comment('お届け先 名字カナ');
            $table->string('user_delivery_location_first_name_kana', 256)->comment('お届け先 名前カナ');
            $table->date('user_delivery_location_birthday')->comment('お届け先 生年月日');
            $table->string('user_delivery_location_zip', 20)->comment('お届け先 郵便番号');
            $table->string('user_delivery_location_address1', 256)->comment('お届け先 住所1');
            $table->string('user_delivery_location_tel1', 20)->comment('お届け先 電話番号');
            $table->string('coupon_name')->nullable()->comment('クーポン名');
            $table->string('coupon_code')->nullable()->comment('クーポンコード');
            $table->integer('total_num')->default(0)->comment('購入数合計');
            $table->integer('total_product_price')->default(0)->comment('全商品値段合計(税込み価格)');
            $table->integer('total_product_include_tax')->default(0)->comment('全内消費税合計');
            $table->integer('total_delivery_charge')->default(0)->comment('(送料合計)');
            $table->integer('fee')->default(0)->comment('手数料');
            $table->integer('total_price')->default(0)->comment('全合計');
            $table->integer('coupon_discount_price')->default(0)->comment('クーポン値引き額');
            $table->dateTime('delivered_at')->nullable()->comment('お届け希望日');
            $table->boolean('status')->default(0)->comment('ステータス 0:仮購入, 1:発送待ち、2:発送済み、3:完了');
            $table->boolean('is_payment')->default(0)->comment('ステータス 0:未払い, 1:支払い済み');
            $table->string('epsilon_trans_code')->nullable()->comment('epsilonから送られてくるtrans_code');
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
        Schema::drop('orders');
    }
}
