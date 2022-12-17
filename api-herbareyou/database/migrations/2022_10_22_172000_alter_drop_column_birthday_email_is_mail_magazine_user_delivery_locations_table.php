<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDropColumnBirthdayEmailIsMailMagazineUserDeliveryLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_delivery_locations', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('email');
            $table->dropColumn('is_mail_magazine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_delivery_locations', function (Blueprint $table) {
            $table->string('email', 256)->nullable()->comment('メールアドレス');
            $table->date('birthday')->nullable()->comment('生年月日');
            $table->boolean('is_mail_magazine')->nullable()->comment('メールマジンを配信するかどうか');
        });
    }
}
