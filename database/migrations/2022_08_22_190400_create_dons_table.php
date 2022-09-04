<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('association_id')->nullable()->constrained('associations');
            $table->foreignId('donateur_id')->constrained('donateurs');
            $table->string('titre');
            $table->string('category');
            $table->string('etat');
            $table->string('adresse');
            $table->text('description');
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->integer('nombre_reserve')->default(0);
            $table->integer('disponible')->default(0);
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
        Schema::dropIfExists('dons');
    }
}