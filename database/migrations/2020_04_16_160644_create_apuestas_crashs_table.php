<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuestasCrashsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apuestas_crashs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idGame');
            $table->unsignedDouble('quantity');
            $table->unsignedDouble('withdraw');
            $table->unsignedDouble('result');
            $table->timestamps();
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idGame')->references('id')->on('crash_partidas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apuestas_crash');
    }
}
