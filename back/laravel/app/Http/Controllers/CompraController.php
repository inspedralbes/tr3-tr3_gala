<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Butaca;
use App\Models\User; 
use Illuminate\Support\Facades\Mail; 
use App\Mail\PurchaseReceipt;


class CompraController extends Controller
{
    public function mostrarCompra()
    {
        $compra = Compra::all();
        return response()->json($compra);
    }

    public function mostrarComprasPorUsuario(Request $request)
    {
        $user = User::where('email', $request->input('userEmail'))->first();
        $compras = Compra::where('id_user', $user->id)->get();
        return response()->json($compras);
    }
   
    public function guardarCompra(Request $request)
    {
        $data = $request->all();

  
        $user = User::where('email', $data['userEmail'])->first();

        foreach ($data['seats'] as $seatData) {
            $butaca = new Butaca();

            $butaca->id = $seatData['id'];
            $butaca->precio = $seatData['price'];
            $butaca->ocupacion = $seatData['status'];

            $butaca->save();

            $compra = new Compra();

            $compra->sesion_id = $data['sessionId'];
            $compra->butaca_id = $butaca->id;
            $compra->id_user = $user->id; 

            $compra->save();
        }

        $dataSend = [
            'seats' => $data['seats'],
            'session' => $data['sessionId'],
            'totalPrice' => array_reduce($data['seats'], function ($carry, $seat) {
                return $carry + $seat['price'];
            }, 0),
        ];

       
        Mail::to($user->email)->send(new PurchaseReceipt($dataSend));

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
    public function actualizarButacas(Request $request)
    {
        $data = $request->all();

        foreach ($data['seats'] as $seatData) {
            $butaca = Butaca::find($seatData['id']);

            $butaca->precio = $seatData['price'];
            $butaca->ocupacion = $seatData['status'];

            $butaca->save();
        }

        return response()->json(['message' => 'Butacas actualizadas']);
    }
}