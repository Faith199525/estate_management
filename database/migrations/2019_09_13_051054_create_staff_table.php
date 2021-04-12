<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('gender')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();
            $table->string('job')->nullable();
            $table->string('email')->nullable();
            $table->longText('details')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('host_id'); // User using staff services

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('host_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
