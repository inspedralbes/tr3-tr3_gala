<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'titol' => $pelicula['titol'], 
                'descripcio' => $pelicula['descripcio'],
                'director' => $pelicula['director'],
                'any' => $pelicula['any'],
                'url' => $pelicula['url'],
            ]);
        }
    }
}


