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
            $table->dateTime('date_rencontre');
            $table->integer('latitude')->nullable();
            $table->integer('longitude')->nullable();
            $table->string('description');
            $table->string('images')->nullable();
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
