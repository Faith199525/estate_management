<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');

            // $table->unsignedInteger('due_id');
            // $table->unsignedInteger('paymentable_id');
            // $table->string('paymentable_type');
            
            // $table->string('due_quantity');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('created_by')->nullable();
            $table->jsonb('dues_paid');
            $table->string('amount'); // Amount is saved in kobo
            $table->text('note')->nullable();
            $table->string('channel')->nullable();
            $table->string('trans_ref')->nullable();
            $table->string('authorization_code')->nullable();
            $table->jsonb('paystack_dump')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
