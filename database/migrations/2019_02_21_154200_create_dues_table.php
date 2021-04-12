<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('details')->nullable();
            $table->string('type'); //Types are daily, weekly, monthly, yearly, oneTime dues
            $table->string('payer'); //payers are residents, landlords, residentlandords
            $table->string('amount'); // Amount is saved in kobo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dues');
    }
}
