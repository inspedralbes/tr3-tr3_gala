<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelicules', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('genere');
            $table->string('preu');
            $table->string('descripcio');
            $table->string('imatge_url');
            $table->string('duracio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelicules');
    }
};
