<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_no')->nullable();
            $table->text('address')->nullable();
            $table->string('zone')->nullable();
            $table->string('building_type')->nullable();
            $table->string('no_of_apartments')->nullable();

            $table->unsignedInteger('landlord_id');
            $table->unsignedInteger('street_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('landlord_id')->references('id')->on('landlords');
            $table->foreign('street_id')->references('id')->on('streets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
