<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNewProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_produits', function (Blueprint $table) {
            $table->string('reference')->nullable();
            $table->integer('paiement_facilite_3_mois')->nullable();
            $table->integer('paiement_facilite_6_mois')->nullable();
            $table->integer('paiement_facilite_12_mois')->nullable();
            $table->integer('prix_achat');
            $table->integer('prix_sold')->nullable();
            $table->string('url_externe')->nullable();
            $table->string('etat_produit');
            $table->boolean('etat');
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
