<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuestasRuletaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apuestas_ruleta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idGame');
            $table->unsignedDouble('quantity');
            $table->unsignedDouble('result');
            $table->string('color'); 
            $table->timestamps();
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idGame')->references('id')->on('ruleta_partidas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apuestas_ruleta');
    }
}
