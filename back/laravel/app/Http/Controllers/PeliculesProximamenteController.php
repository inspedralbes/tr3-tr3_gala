<?php

namespace App\Http\Controllers;

use App\Models\PeliculesProximamente;
use Illuminate\Http\Request;

class PeliculesProximamenteController extends Controller
{
    public function showPeliculasProximamente()
    {
        $peliculasProximamente = PeliculesProximamente::all();
        return response()->json($peliculasProximamente);
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

        $peliculaProxima = new PeliculesProximamente([
            'titol' => $request->get('titol'),
            'descripcio' => $request->get('descripcio'),
            'director' => $request->get('director'),
            'any' => $request->get('any'),
            'url' => $request->get('url'),
        ]);

        $peliculaProxima->save();

        return response()->json('Película añadida con éxito');
    }

    public function destroy($id)
    {
        $peliculaProxima = PeliculesProximamente::find($id);

        if ($peliculaProxima) {
            $peliculaProxima->delete();
            return response()->json(['message' => 'Película eliminada con éxito'], 200);
        } else {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }
    }
}