<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PPSeeder extends Seeder
{
    public function run()
    {
        $data = File::get(database_path('../pelicules2.json'));
        $movies = json_decode($data);

        foreach ($movies as $movie) {
            DB::table('peliculas_proximamente')->insert([
                'id' => $movie->id,
                'titol' => $movie->titol,
                'descripcio' => $movie->descripcio,
                'director' => $movie->director,
                'any' => $movie->any,
                'url' => $movie->url,
            ]);
        }
    }
}