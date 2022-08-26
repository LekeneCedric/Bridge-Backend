<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouvementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('association_id')->constrained('associations');
            $table->string('category');
            $table->string('intitule');
            $table->date('date_rencontre');
            $table->string('heure_debut');
            $table->string('heure_fin');
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->text('description');
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
        Schema::dropIfExists('mouvements');
    }
}
