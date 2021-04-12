<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estate_id');
            $table->string('mail_from_name')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('payment_activated')->nullable();
            $table->string('payment_account_no')->nullable();
            $table->string('settlement_bank')->nullable();
            $table->string('business_name')->nullable();
            $table->string('subaccount_code')->nullable();
            $table->string('manual_due_management_activated')->nullable();
            $table->string('messaging_activated')->nullable();
            $table->string('activate_email')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('settings');
    }
}
