<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoueElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roue_elements', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('value');
            $table->boolean('win');
            $table->string('resultText');
            $table->string('color');
            $table->unsignedBigInteger('roue_id');
            $table->foreign('roue_id')->references('id')->on('roues');
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
        Schema::dropIfExists('roue_elements');
    }
}
