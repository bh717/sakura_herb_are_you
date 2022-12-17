<?php

use Illuminate\Database\Migrations\Migration;

class AlterChangeColumnProductRecommendationsKind extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `product_recommendations` CHANGE COLUMN `kind` `kind` TINYINT NOT NULL COMMENT '1:HEALING, kind: 2:INSPIRATION, 3:MAINTENANCE, 4:今月のおすすめハーブティー'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `product_recommendations` CHANGE COLUMN `kind` `kind` BIGINT NOT NULL COMMENT '1:HEALING, kind: 2:INSPIRATION, 3:MAINTENANCE, 4:今月のおすすめハーブティー'");
    }
}
