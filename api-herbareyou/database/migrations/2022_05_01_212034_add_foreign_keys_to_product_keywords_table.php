<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_keywords', function (Blueprint $table) {
            $table->foreign('product_id', 'product_keywords_product_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_keywords', function (Blueprint $table) {
            $table->dropForeign('product_keywords_product_id_fk');
        });
    }
}
