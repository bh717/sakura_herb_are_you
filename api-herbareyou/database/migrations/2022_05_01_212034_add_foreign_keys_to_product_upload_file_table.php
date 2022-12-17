<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductUploadFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_upload_file', function (Blueprint $table) {
            $table->foreign('product_id', 'product_upload_file_product_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('upload_file_id', 'product_upload_file_upload_file_id_fk')->references('id')->on('upload_files')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_upload_file', function (Blueprint $table) {
            $table->dropForeign('product_upload_file_product_id_fk');
            $table->dropForeign('product_upload_file_upload_file_id_fk');
        });
    }
}
