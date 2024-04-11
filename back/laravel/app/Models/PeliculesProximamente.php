<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculesProximamente extends Model
{
    use HasFactory;

    // Si el nombre de tu tabla no es 'peliculas_proximamentes', especifica el nombre correcto aquí
    protected $table = 'peliculas_proximamente';

    // Si tus columnas no son 'titol', 'descripcio', 'director', 'any', 'url', especifica las correctas aquí
    protected $fillable = ['titol', 'descripcio', 'director', 'any', 'url'];
}