<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image_profile_path')->nullable()->default('4.jpg');;
            $table->string('image_profile_name')->nullable()->default('4.jpg');
            $table->string('image_coverture_path')->nullable()->default('4.jpg');
            $table->string('image_coverture_name')->nullable()->default('4.jpg');
            $table->string('etat')->nullable()->default(true);
            $table->string('username')->nullable();
            $table->string('site_web')->nullable()->default('https://www.facebook.com/');
            $table->string('site_fb')->nullable()->default('https://www.facebook.com/');
            $table->boolean('sex')->default(true);
            $table->text('description')->nullable()->default('votre description here');
            $table->date('date_de_naissance')->nullable()->default(date('Y-m-d'));;
            $table->unsignedBigInteger('societe_id');
            $table->foreign('societe_id')->references('id')->on('societes');
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
