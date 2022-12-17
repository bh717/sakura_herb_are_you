<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('total_product_include_tax')
                ->default(0)
                ->comment('商品内税合計')
                ->change();

            $table->integer('total_delivery_charge_include_tax')
                ->default(0)
                ->after('total_delivery_charge')
                ->comment('送料内税');
            $table->tinyInteger('total_delivery_charge_include_tax_rate')
                ->default(0)
                ->after('total_delivery_charge_include_tax')
                ->comment('送料内税率');

            $table->integer('fee_include_tax')
                ->default(0)
                ->after('fee')
                ->comment('決済手数料内税');
            $table->tinyInteger('fee_include_tax_rate')
                ->default(0)
                ->after('fee_include_tax')
                ->comment('決済手数料内税率');

            $table->integer('total_include_tax')
                ->default(0)
                ->after('total_price')
                ->comment('内税合計');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('product_capacity')
                ->default('')
                ->comment('商品容量')
                ->change();
            $table->string('product_price_capacity')
                ->default('')
                ->after('product_description')
                ->comment('商品値段容量(購入した容量)');
            $table->string('keyword_id_csv')
                ->default('')
                ->after('material_id_csv')
                ->comment('キーワードid_csv');
            $table->string('keyword_name_csv')
                ->default('')
                ->after('material_name_csv')
                ->comment('キーワードname_csv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('total_product_include_tax')->default(0)->comment('全内消費税合計')->change();
            $table->dropColumn('total_delivery_charge_include_tax');
            $table->dropColumn('total_delivery_charge_include_tax_rate');
            $table->dropColumn('fee_include_tax');
            $table->dropColumn('fee_include_tax_rate');
            $table->dropColumn('total_include_tax');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('product_capacity')
                ->comment('商品値段容量')
                ->change();
            $table->dropColumn('product_price_capacity');
            $table->dropColumn('keyword_id_csv');
            $table->dropColumn('keyword_name_csv');
        });
    }
}
