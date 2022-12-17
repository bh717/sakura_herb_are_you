<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTherapistBlogUploadFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('therapist_blog_upload_file', function (Blueprint $table) {
            $table->foreign('therapist_blog_id', 'therapist_blog_upload_file_product_id_fk')->references('id')->on('therapist_blogs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('upload_file_id', 'therapist_blog_upload_file_upload_file_id_fk')->references('id')->on('upload_files')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('therapist_blog_upload_file', function (Blueprint $table) {
            $table->dropForeign('therapist_blog_upload_file_product_id_fk');
            $table->dropForeign('therapist_blog_upload_file_upload_file_id_fk');
        });
    }
}
