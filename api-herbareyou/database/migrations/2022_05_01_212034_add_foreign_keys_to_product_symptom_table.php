<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductSymptomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_symptom', function (Blueprint $table) {
            $table->foreign('product_id', 'product_symptom_product_id_fk')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('symptom_id', 'product_symptom_symptom_id_fk')->references('id')->on('symptoms')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_symptom', function (Blueprint $table) {
            $table->dropForeign('product_symptom_product_id_fk');
            $table->dropForeign('product_symptom_symptom_id_fk');
        });
    }
}
