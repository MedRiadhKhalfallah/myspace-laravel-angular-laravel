<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roues', function (Blueprint $table) {
            $table->id();
            $table->integer('svgWidth')->default(1024);
            $table->integer('svgHeight')->default(768);
            $table->string('wheelStrokeColor')->default("#D0BD0C");
            $table->integer('wheelStrokeWidth')->default(18);
            $table->integer('wheelSize')->default(700);
            $table->integer('wheelTextOffsetY')->default(80);
            $table->string('wheelTextColor')->default("#EDEDED");
            $table->string('wheelTextSize')->default("2.3em");
            $table->integer('wheelImageOffsetY')->default(40);
            $table->integer('wheelImageSize')->default(50);
            $table->integer('centerCircleSize')->default(360);
            $table->string('centerCircleStrokeColor')->default("#F1DC15");
            $table->integer('centerCircleStrokeWidth')->default(12);
            $table->string('centerCircleFillColor')->default("#EDEDED");
            $table->string('segmentStrokeColor')->default("#E2E2E2");
            $table->integer('segmentStrokeWidth')->default(4);
            $table->integer('centerX')->default(512);
            $table->integer('centerY')->default(384);
            $table->boolean('hasShadows')->default(false);
            $table->integer('numSpins')->default(2);
            $table->integer('minSpinDuration')->default(6);
            $table->string('gameOverText')->default("J''espère que vous avez apprécié la roue .<br>Maintenant, allez visiter<a href=''https:maintenancetn.tn'' target=''_blank''>notre site</a> :)");
            $table->string('invalidSpinText')->default("INVALID SPIN. PLEASE SPIN AGAIN.");
            $table->string('introText')->default("VOUS DEVEZ <br>LE TOURNER <span style=''color:#1315f2;''>2</span> GAGNER!");
            $table->boolean('hasSound')->default(true);
            $table->boolean('clickToSpin')->default(true);
            $table->date('date_fin_abonnement')->nullable()->default(date('Y-m-d'));
            $table->string('etat')->nullable()->default(false);
            $table->unsignedBigInteger('societe_id');
            $table->foreign('societe_id')->references('id')->on('societes');
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
        Schema::dropIfExists('roues');
    }
}
