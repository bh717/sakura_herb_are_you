<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserResetPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_reset_passwords', function (Blueprint $table) {
            $table->foreign('user_id', 'user_reset_passwords_user_id_fk')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_reset_passwords', function (Blueprint $table) {
            $table->dropForeign('user_reset_passwords_user_id_fk');
        });
    }
}
