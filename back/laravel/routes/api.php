<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculesController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SessioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/pelicules', [PeliculesController::class, 'showPelicules']);

Route::get('/peliculas', [PeliculesController::class, 'index']);
Route::get('/peliculasForm', [PeliculesController::class, 'showForm']);
Route::post('/peliculas', [PeliculesController::class, 'store']);
Route::get('/peliculas/{id}', [PeliculesController::class, 'show']);

// Route::get('/entradas/{id}', [EntradaController::class, 'show']);
Route::post('/entradas', [EntradaController::class, 'store']);

Route::get('/sesiones', [SessioController::class, 'index']);
Route::post('/sesiones', [SessioController::class, 'store']);
Route::get('/sesiones/{id}', [SessioController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
