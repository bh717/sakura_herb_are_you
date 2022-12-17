<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapistBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapist_blogs', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('therapist_id')->index('therapist_id')->comment('セラピストid');
            $table->string('title')->default('0')->comment('タイトル');
            $table->string('body', 2000)->default('0')->comment('内容');
            $table->boolean('is_public')->default(1)->comment('公開フラグ');
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
        Schema::drop('therapist_blogs');
    }
}
