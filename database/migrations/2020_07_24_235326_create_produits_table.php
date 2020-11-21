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
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('prix');
            $table->boolean('etat')->default(false);
            $table->unsignedBigInteger('sous_categorie_id');
            $table->foreign('sous_categorie_id')->references('id')->on('sous_categories');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('adresse_id')->nullable();
            $table->foreign('adresse_id')->references('id')->on('adresses');
            $table->string('type_de_transaction')->nullable();
            $table->integer('chambres')->nullable();
            $table->integer('salles_de_bains')->nullable();
            $table->integer('superficie')->nullable();
            $table->string('couleur_du_véhicule')->nullable();
            $table->string('type_de_carrosserie')->nullable();
            $table->string('etat_du_vehicule')->nullable();
            $table->string('boite')->nullable();
            $table->string('cylindree')->nullable();
            $table->integer('kilometrage')->nullable();
            $table->integer('annee')->nullable();
            $table->string('carburant')->nullable();
            $table->integer('puissance_fiscale')->nullable();
            $table->boolean('livraison')->nullable();
            $table->integer('prix_livraison')->nullable();
            $table->unsignedBigInteger('modele_id');
            $table->foreign('modele_id')->references('id')->on('modeles');
            $table->unsignedBigInteger('marque_id');
            $table->foreign('marque_id')->references('id')->on('marques');
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
