<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\Pelicules;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SessionsController extends Controller
{
    public function mostrarSesion()
    {
   
        $sessions = Sessions::all();
        Log::info($sessions);
     
        $sesionesConPelicula = [];
    
        foreach ($sessions as $session) {
          
            $peliculaId = $session->pelicula_id;
            Log::info("Pelicula id: $peliculaId");
        
            $pelicula = Pelicules::find($peliculaId);
        
            if ($pelicula) {
            
                $sesionesConPelicula[] = [
                    'sesion' => $session,
                    'pelicula' => [
                        'titulo' => $pelicula->títol,
                        'descripcion' => $pelicula->descripció,
                        'imagen' => $pelicula->url
                      
                    ]
                ];
            } else {
                Log::info("No hay pelicula asociada a la sesion");
            }
        }
        Log::info($sesionesConPelicula);
        
        return response()->json(['sessions' => $sesionesConPelicula]);
    }
    public function getPurchasedSeats($sessionId)
    {
        // Buscar todas las compras para la sesión dada
        $purchases = Compra::where('sesion_id', $sessionId)->get();

        // Extraer los IDs de las butacas
        $seatIds = $purchases->pluck('butaca_id');

        return response()->json($seatIds);
    }
    public function deleteSession($id)
{
    $session = Sessions::find($id);

    if (!$session) {
        return response()->json(['error' => 'Session not found'], 404);
    }

    $session->delete();

    return response()->json(['message' => 'Session deleted successfully']);
}

public function addSession(Request $request)
{
    $this->validate($request, [
        'pelicula_id' => 'required|exists:pelicules,id',
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i',
    ]);

    $session = Sessions::create($request->all());

    return response()->json(['message' => 'Session added successfully', 'session' => $session]);
}
    

}