<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSocietesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('societes', function (Blueprint $table) {
            $table->string('notre_code_invitation')->unique();
            $table->string('votre_code_invitation')->nullable();
            $table->string('reference_societe')->unique();
            $table->unsignedBigInteger('type_activite_id');
            $table->foreign('type_activite_id')->references('id')->on('type_activites');
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
