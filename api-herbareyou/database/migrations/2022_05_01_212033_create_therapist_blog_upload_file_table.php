<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTherapistBlogUploadFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapist_blog_upload_file', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->bigInteger('therapist_blog_id')->index('therapist_blog_id');
            $table->bigInteger('upload_file_id')->index('upload_file_id');
            $table->smallInteger('sort_order')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('therapist_blog_upload_file');
    }
}
