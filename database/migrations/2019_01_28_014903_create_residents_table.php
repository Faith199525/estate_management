<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('occupation')->nullable();
            $table->text('office_address')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('no_of_occupants')->nullable();
            $table->string('occupancy_start_date')->nullable();
            $table->string('no_of_vehicles')->nullable();
            $table->text('vehicle_type_and_registration_numbers')->nullable();
            $table->boolean('moved_out')->default(false)->nullable();
            $table->string('photo')->nullable();

            $table->unsignedInteger('property_id');
            $table->unsignedInteger('user_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
}
