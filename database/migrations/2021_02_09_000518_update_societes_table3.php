<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSocietesTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('societes', function (Blueprint $table) {
            $table->dropColumn('ville');
            $table->unsignedBigInteger('delegation_id');
            $table->foreign('delegation_id')->references('id')->on('delegations');
            $table->unsignedBigInteger('gouvernorat_id');
            $table->foreign('gouvernorat_id')->references('id')->on('gouvernorats');
            $table->unsignedBigInteger('localite_id')->nullable();
            $table->foreign('localite_id')->references('id')->on('localites');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
