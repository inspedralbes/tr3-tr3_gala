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

        // Guardar la compra en la base de datos
        $compra->save();
    }

    // Devolver la compra en formato JSON
    return response()->json($compra);
}

}