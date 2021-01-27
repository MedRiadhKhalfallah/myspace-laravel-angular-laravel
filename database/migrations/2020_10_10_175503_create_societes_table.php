<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocietesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse');
            $table->string('complement_adresse')->nullable();
            $table->integer('code_postal');
            $table->string('ville');
            $table->string('telephone_mobile');
            $table->string('telephone_fix')->nullable();
            $table->string('numero_tva')->nullable();
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->string('email')->unique();
            $table->string('image_societe_path')->nullable()->default('4.jpg');
            $table->string('image_societe_name')->nullable()->default('4.jpg');
            $table->string('image_coverture_path')->nullable()->default('4.jpg');
            $table->string('image_coverture_name')->nullable()->default('4.jpg');
            $table->string('etat')->nullable()->default(true);
            $table->string('site_web')->nullable()->default('https://www.facebook.com/');
            $table->string('site_fb')->nullable()->default('https://www.facebook.com/');
            $table->text('description')->nullable();
            $table->string('type_abonnement')->nullable();
            $table->date('date_fin_abonnement')->nullable()->default(date('Y-m-d'));

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
        Schema::dropIfExists('societes');
    }
}
