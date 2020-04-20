<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinflipPartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinflip_partidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser1');
            $table->unsignedBigInteger('idUser2');
            $table->string('winner');
            $table->string('status');
            $table->unsignedDouble('quantity');
            $table->timestamps();
            $table->foreign('idUser1')->references('id')->on('users');
            $table->foreign('idUser2')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coinflip_partidas');
    }
}
