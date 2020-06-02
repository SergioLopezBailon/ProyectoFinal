<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuletaPartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruleta_partidas', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('winner')->nullable();
            $table->string('timeRuleta');
            $table->string('timeBets');
            $table->string('timeEnd');
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
        Schema::dropIfExists('ruleta_partidas');
    }
}
