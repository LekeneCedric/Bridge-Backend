<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donateurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('surname',50);
            $table->string('email',50);
            $table->date('date_naissance')->nullable();
            $table->string('sexe');
            $table->string('contact');
            $table->string('pays');
            $table->string('ville');
            $table->string('password');
            $table->boolean('verifie')->default(false);
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
        Schema::dropIfExists('donateurs');
    }
}
