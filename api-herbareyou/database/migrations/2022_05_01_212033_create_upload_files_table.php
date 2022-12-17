<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('size')->nullable();
            $table->string('hash', 256)->nullable();
            $table->string('file_path', 256)->nullable();
            $table->string('mime_type', 256)->nullable();
            $table->string('file_type', 16)->nullable();
            $table->string('file_name', 512)->nullable();
            $table->string('storage_kind', 256)->nullable();
            $table->boolean('is_confirm')->nullable()->default(0);
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
        Schema::drop('upload_files');
    }
}
