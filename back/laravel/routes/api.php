<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculesController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AuthController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**RUTES DE COMPRA */
Route::post('/{sessionId}/ocupadas',  [CompraController::class, 'obtenerButacasOcupadas']);
Route::post('/efectuarCompra', [CompraController::class, 'guardarCompra']);
Route::get('/compras', [CompraController::class, 'mostrarCompra']);
Route::get('/comprasPorUsuario', [CompraController::class, 'mostrarComprasPorUsuario']);
Route::post('/{sessionId}/ocupadas',  [CompraController::class, 'obtenerButacasOcupadas']);
Route::get('/actualizarButacas', [CompraController::class, 'actualizarButacas']);

/**RUTES DE SESSIONS */
Route::get('/sessions', [SessionsController::class, 'mostrarSesion']);
Route::get('/sessions/{sessionId}/purchasedSeats', [SessionsController::class, 'getPurchasedSeats']);


/** RUTES DE PELÍCULES */
Route::get('/pelicules', [PeliculesController::class, 'showPelicules']);

/**RUTES DE AUTENTICACIO */
Route::post('/registre', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/user', [AuthController::class, 'getUser']);
Route::get('/user', [AuthController::class, 'getUser']);
Route::put('/updateUser', [AuthController::class, 'updateUser']);
Route::get('/getUsers', [AuthController::class, 'getUsers']);
Route::put('/updateUserList', [AuthController::class, 'updateUserList']);
Route::delete('/deleteUser/{email}', [AuthController::class, 'deleteUser']);