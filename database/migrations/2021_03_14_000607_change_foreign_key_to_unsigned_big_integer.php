<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignKeyToUnsignedBigInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('landlords', function (Blueprint $table) {
            $table->dropForeign('landlords_user_id_foreign');
        });
        Schema::table('landlords', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('residents', function (Blueprint $table) {
            $table->dropForeign('residents_user_id_foreign');
        });
        Schema::table('residents', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('accesses', function (Blueprint $table) {
            $table->dropForeign('accesses_user_id_foreign');
        });
        Schema::table('accesses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_user_id_foreign');
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_user_id_foreign');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
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

    }
}
