<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserResetPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reset_passwords', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('user_id')->index('user_id')->comment('ユーザーid');
            $table->string('code', 256)->nullable()->comment('コード');
            $table->dateTime('expired_at')->comment('有効期限');
            $table->boolean('is_delete')->default(0)->comment('削除フラグ deleted_atと用いること');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->unique(['code','is_delete'], 'code_is_delete_uq');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_reset_passwords');
    }
}
