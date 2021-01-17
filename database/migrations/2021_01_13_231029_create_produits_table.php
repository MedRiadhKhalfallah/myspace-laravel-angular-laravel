<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('nom_client')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('etat')->default('en attend');
            $table->string('reference')->unique();
            $table->text('description_agent')->nullable();
            $table->text('description_client')->nullable();
            $table->unsignedBigInteger('societe_id');
            $table->foreign('societe_id')->references('id')->on('societes');
            $table->unsignedBigInteger('createur_id');
            $table->foreign('createur_id')->references('id')->on('users');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
