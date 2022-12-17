<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTherapistBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('therapist_blogs', function (Blueprint $table) {
            $table->foreign('therapist_id', 'therapist_blogs_therapist_id_fk')->references('id')->on('therapists')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('therapist_blogs', function (Blueprint $table) {
            $table->dropForeign('therapist_blogs_therapist_id_fk');
        });
    }
}
