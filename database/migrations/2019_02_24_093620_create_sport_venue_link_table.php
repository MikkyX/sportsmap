<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportVenueLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_venue', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sport_id');
            $table->unsignedInteger('venue_id');
            $table->unsignedInteger('subtype_id');
            $table->timestamps();

            $table->foreign('sport_id')->references('id')->on('sports');
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->foreign('subtype_id')->references('id')->on('subtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sport_venue');
    }
}
