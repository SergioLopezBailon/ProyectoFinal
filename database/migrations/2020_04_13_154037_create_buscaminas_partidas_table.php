<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuscaminasPartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buscaminas_partidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->integer('idMode');
            $table->unsignedDouble('multuplicator');
            $table->unsignedDouble('quantity');
            $table->string('status');
            $table->unsignedDouble('result');
            $table->string('map');
            $table->timestamps();
            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buscaminas_partidas');
    }
}
