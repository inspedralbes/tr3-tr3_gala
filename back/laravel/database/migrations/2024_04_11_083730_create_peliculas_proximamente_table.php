<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeliculasProximamenteTable extends Migration
{
    public function up()
    {
        Schema::create('peliculas_proximamente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titol');
            $table->text('descripcio');
            $table->string('director');
            $table->integer('any');
            $table->string('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('peliculas_proximamente');
    }
}