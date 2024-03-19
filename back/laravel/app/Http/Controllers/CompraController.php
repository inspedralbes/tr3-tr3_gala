<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Butaca;

class CompraController extends Controller
{
    public function mostrarCompra()
    {
        $compra = Compra::all();
        return response()->json($compra);
    }
   

    public function guardarCompra(Request $request)
    {
        $data = $request->all();

        foreach ($data['seats'] as $seatData) {
            $butaca = new Butaca();

            $butaca->id = $seatData['id'];
            $butaca->precio = $seatData['price'];
            $butaca->ocupacion = $seatData['status'];


            $butaca->save();

            $compra = new Compra();

            $compra->sesion_id = $data['sessionId'];
            $compra->butaca_id = $butaca->id;

           
            $compra->save();
        }

       
        return response()->json($compra);
    }
    public function obtenerButacasOcupadas($sessionId)
    {
        
        $compras = Compra::where('sesion_id', $sessionId)->get();

        
        $butacasOcupadas = [];

       
        foreach ($compras as $compra) {
            $butacasOcupadas[] = $compra->butaca_id;
        }

       
        $butacas = Butaca::whereIn('id', $butacasOcupadas)->where('ocupacion', 'ocupado')->get();

        return response()->json($butacas);
    }
}
