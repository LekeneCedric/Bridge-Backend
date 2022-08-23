<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('name');
            $table->string('category');
            $table->string('pays');
            $table->string('ville');
            $table->string('contact');
            $table->string('email');
            $table->string('adresse');
            $table->string('siteweb');
            $table->string('numero_contribuable')->nullable();
            $table->string('password');
            $table->string('vpassword')->nullable();
            $table->string('nom_responsable');
            $table->string('imagesProfil')->nullable();
            $table->integer('longitude')->nullable();
            $table->integer('latitude')->nullable();
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
        Schema::dropIfExists('associations');
    }
}
