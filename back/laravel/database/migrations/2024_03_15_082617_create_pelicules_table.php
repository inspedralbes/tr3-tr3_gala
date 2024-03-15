<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelicules', function (Blueprint $table) {
            $table->id();
            $table->string('titol'); // Cambiado de 'nom' a 'títol'
            $table->text('descripcio'); // Cambiado de 'descripció' a 'text'
            $table->string('director');
            $table->unsignedSmallInteger('any'); // Cambiado de 'any_estrena' a 'unsignedSmallInteger'
            $table->string('url'); // Cambiado de 'url_imatge' a 'enllaç_imatge'
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
        Schema::dropIfExists('pelicules');
    }
};
