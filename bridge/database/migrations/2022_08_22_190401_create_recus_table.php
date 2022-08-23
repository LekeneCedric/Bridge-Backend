<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contenu');
            $table->foreignId('don_id')->constrained('dons');
            $table->foreignId('association_id')->constrained('associations');
            $table->foreignId('donateur_id')->constrained('donateurs');
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
        Schema::dropIfExists('recus');
    }
}
