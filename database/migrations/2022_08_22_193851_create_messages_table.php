<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('donateur_id')->constrained('donateurs');
            $table->integer('receiver_id');
            $table->text('contenu');
            $table->integer('sender');
            $table->integer('receiver');
            $table->integer('vu')->default(0);
            $table->foreignId('demande_id')->nullable()->constrained('demandes');
            $table->foreignId('don_id')->nullable()->constrained('dons');
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
        Schema::dropIfExists('messages');
    }
}
