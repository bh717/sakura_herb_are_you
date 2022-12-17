<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductPopularationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_popularations', function (Blueprint $table) {
            $table->foreign('product_id', 'product_popularations_product_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_popularations', function (Blueprint $table) {
            $table->dropForeign('product_popularations_product_id_fk');
        });
    }
}
