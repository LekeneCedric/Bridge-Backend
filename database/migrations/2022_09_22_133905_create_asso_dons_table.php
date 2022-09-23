<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssoDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asso_dons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('association_id')->constrained('associations')->onDelete('cascade');
            $table->foreignId('donateur_id')->constrained('donateurs')->onDelete('cascade');
            $table->foreignId('besoin_id')->nullable()->constrained('besoins')->onDelete('cascade');
            $table->string('titre',50);
            $table->string('category');
            $table->string('etat');
            $table->string('adresse');
            $table->text('description');
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
        Schema::dropIfExists('asso_dons');
    }
}
