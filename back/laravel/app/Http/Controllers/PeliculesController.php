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

    public function store(Request $request)
    {
        $request->validate([
            'titol' => 'required',
            'descripcio' => 'required',
            'director' => 'required',
            'any' => 'required',
            'url' => 'required',
        ]);

        $pelicule = new Pelicules([
            'titol' => $request->get('titol'),
            'descripcio' => $request->get('descripcio'),
            'director' => $request->get('director'),
            'any' => $request->get('any'),
            'url' => $request->get('url'),
        ]);

        $pelicule->save();

        return response()->json('Película añadida con éxito');
    }

    public function destroy($id)
    {
        $pelicule = Pelicules::find($id);

        if ($pelicule) {
            $pelicule->delete();
            return response()->json(['message' => 'Película eliminada con éxito'], 200);
        } else {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }
    }
}