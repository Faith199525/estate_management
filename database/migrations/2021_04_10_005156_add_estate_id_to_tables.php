<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstateIdToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('streets', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('dues', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('incidents', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('visitors', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });

        Schema::table('payment_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('estate_id')->nullable();
            $table->foreign('estate_id')->references('id')->on('estates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
