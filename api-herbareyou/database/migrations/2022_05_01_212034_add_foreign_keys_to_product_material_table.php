<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_material', function (Blueprint $table) {
            $table->foreign('material_id', 'product_material_material_id_fk')->references('id')->on('materials')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id', 'product_material_product_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_material', function (Blueprint $table) {
            $table->dropForeign('product_material_material_id_fk');
            $table->dropForeign('product_material_product_id_fk');
        });
    }
}
