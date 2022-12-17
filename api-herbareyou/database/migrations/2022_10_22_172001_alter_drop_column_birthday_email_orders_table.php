<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDropColumnBirthdayEmailOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('user_delivery_location_email');
            $table->dropColumn('user_delivery_location_birthday');
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
            $table->string('user_delivery_location_email', 256)->nullable()->comment('メールアドレス');
            $table->date('user_delivery_location_birthday')->nullable()->comment('生年月日');
        });
    }
}
