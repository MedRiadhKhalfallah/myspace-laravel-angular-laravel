<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_produits', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->integer('quantite');
            $table->integer('seuil_min')->default(5);
            $table->integer('prix')->nullable();
            $table->string('image_path');
            $table->string('image_name');
            $table->unsignedBigInteger('societe_id');
            $table->foreign('societe_id')->references('id')->on('societes');
            $table->unsignedBigInteger('sous_category_id');
            $table->foreign('sous_category_id')->references('id')->on('sous_categories');
            $table->unsignedBigInteger('modele_id');
            $table->foreign('modele_id')->references('id')->on('modeles');
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
        Schema::dropIfExists('new_produits');
    }
}
