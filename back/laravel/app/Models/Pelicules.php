<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicules extends Model
{
    use HasFactory;

    protected $table = 'pelicules';

    protected $fillable = [
        'id',
        'nom',
        'genere',
        'preu',
        'image_url',
        'descripcio',
        'duracio',
      
    ];

    protected $casts = [
        'butacasOcupadas' => 'array',
    ];
}
