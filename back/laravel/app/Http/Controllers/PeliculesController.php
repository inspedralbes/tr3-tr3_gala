<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicules;

class PeliculesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peliculas = Pelicules::all();
        return Pelicules::all();
    }

    /**
    * Store a newly created resource in storage.
    */
   
    public function store(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255', // 'required' = 'obligatorio', 'string' = 'cadena de texto', 'max:255' = 'máximo 255 caracteres'
            'genere' => 'required|string|max:255',
            'preu' => 'required|string|max:255',
            'descripcio' => 'required|string|max:255',
            'imatge_url' => 'nullable|string|max:255',
            'duracio' => 'required|string|max:255',
        ]);
            
        // Crear nueva película
        $pelicula = Pelicules::create($validatedData);

        // Devolver respuesta
        return response()->json($pelicula, 201); // 201 = Created
    }


    /**
     * Display the specified resource.
     */
    public function show($request)
    {
         // Validación de datos
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255', // 'required' = 'obligatorio', 'string' = 'cadena de texto', 'max:255' = 'máximo 255 caracteres'
            'genere' => 'required|string|max:255',
            'preu' => 'required|string|max:255',
            'descripcio' => 'required|string|max:255',
            'imatge_url' => 'nullable|string|max:255',
            'duracio' => 'required|string|max:255',
        ]);
            
        // Buscar la película por ID
        $pelicula = Pelicules::findOrFail($request->id); // Si no encuentra la película, devolverá un error 404

        // Actualizar la película
        $pelicula->update($validatedData);

        // Devolver respuesta
        return response()->json($pelicula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
