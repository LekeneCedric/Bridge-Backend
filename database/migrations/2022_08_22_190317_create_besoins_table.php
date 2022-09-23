<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBesoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('besoins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('association_id')->constrained('associations')->onDelete('cascade');
            $table->string('contenu');
            $table->string('category');
            $table->integer('attente')->default(0);
            $table->integer('resolu')->default(0);
            $table->integer('quantite');
            $table->integer('quantite_actuelle')->default(0);
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
        Schema::dropIfExists('besoins');
    }
}
