<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductTasteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_taste', function (Blueprint $table) {
            $table->foreign('product_id', 'product_taste_product_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('taste_id', 'product_taste_taste_id_fk')->references('id')->on('tastes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_taste', function (Blueprint $table) {
            $table->dropForeign('product_taste_product_id_fk');
            $table->dropForeign('product_taste_taste_id_fk');
        });
    }
}
