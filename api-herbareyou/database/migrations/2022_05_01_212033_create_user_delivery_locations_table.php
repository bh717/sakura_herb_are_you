<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDeliveryLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_delivery_locations', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->index('user_id')->comment('ユーザーid');
            $table->string('email', 256)->nullable()->comment('メールアドレス');
            $table->string('last_name', 256)->nullable()->comment('名字');
            $table->string('first_name', 256)->nullable()->comment('名前');
            $table->string('last_name_kana', 256)->nullable()->comment('名字カナ');
            $table->string('first_name_kana', 256)->nullable()->comment('名前カナ');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->string('zip', 20)->nullable()->comment('郵便番号');
            $table->string('address1', 256)->nullable()->comment('住所1');
            $table->string('tel1', 20)->nullable()->comment('電話番号');
            $table->boolean('is_mail_magazine')->nullable()->comment('メールマジンを配信するかどうか');
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
        Schema::drop('user_delivery_locations');
    }
}
