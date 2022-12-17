<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('email')->nullable()->comment('メールアドレス');
            $table->string('name')->nullable()->comment('名前');
            $table->string('order_no')->nullable()->comment('注文No');
            $table->string('inquiry', 2000)->nullable()->comment('問い合わせ内容');
            $table->boolean('status')->default(0)->comment('ステータス 0:未対応, 1:対応済み');
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
        Schema::drop('inquiries');
    }
}
