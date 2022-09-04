<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('association_id')->nullable()->default(null)->references('id')->on('associations');
            $table->foreignId('annonce_id')->nullable()->default(null)->references('id')->on('annonces');
            $table->foreignId('donateur_id')->nullable()->default(null)->references('id')->on('donateurs');
            $table->foreignId('don_id')->nullable()->default(null)->references('id')->on('dons');
            $table->foreignId('mouvement_id')->nullable()->default(null)->references('id')->on('mouvements');
            $table->string('filePath');
            $table->string('extension');
            $table->string('fileName');
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
        Schema::dropIfExists('media');
    }
}
