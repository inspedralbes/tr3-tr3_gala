<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessio extends Model
{
    use HasFactory;

    protected $table = 'sesiones';

    protected $fillable = [
        'pelicula_id', 
        'fecha', 
        'dia_espectador', 
        'VIP'
    ];

    public function pelicula()
    {
        return $this->belongsTo(Pelicules::class, 'pelicula_id');
    }
}

