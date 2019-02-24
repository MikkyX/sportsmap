<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator_id');
            $table->string('name', 100);
            $table->string('address', 150);
            $table->string('postcode', 8);
            $table->decimal('latitude', 12, 8)->index();
            $table->decimal('longitude', 12, 8)->index();
            $table->string('website', 100);
            $table->string('telephone', 20);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('creator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venues');
    }
}
