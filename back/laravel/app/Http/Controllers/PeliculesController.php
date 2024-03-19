<?php

namespace App\Http\Controllers;

use App\Models\Pelicules;
use Illuminate\Http\Request;

class PeliculesController extends Controller
{
    public function showPelicules()
    {
       
        $pelicules = Pelicules::all();

      
        return response()->json($pelicules);
    }
}

?>