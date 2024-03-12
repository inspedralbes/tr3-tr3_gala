<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelicules;
use Illuminate\Support\Facades\File;

class PeliculesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path('../pelicules.json'));
        $pelicules = json_decode($json, true);

        foreach ($pelicules as $pelicula) {
            Pelicules::create([
                'nom' => $pelicula['nom'],
                'genere' => $pelicula['genere'],
                'preu' => $pelicula['preu'],
                'descripcio' => $pelicula['descripcio'],
                'imatge_url' => $pelicula['imatge_url'], // Aquí está el cambio
                'duracio' => $pelicula['duracio'],
            ]);
        }
    }
}