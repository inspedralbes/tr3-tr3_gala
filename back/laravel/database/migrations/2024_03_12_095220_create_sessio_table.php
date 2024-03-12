<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessioTable extends Migration
{
    public function up()
    {
        Schema::create('sessio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelicula_id')->constrained('pelicules')->onDelete('cascade');
            $table->date('fecha');
            $table->boolean('dia_espectador');
            $table->boolean('VIP');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessio');
    }
}

