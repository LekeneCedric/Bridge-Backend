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
            $table->string('adresse');
            $table->string('numero_contribuable')->nullable();
            $table->string('password');
            $table->string('nom_responsable');
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->boolean('verifie')->default(false);
            $table->boolean('valide')->default(false);
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
