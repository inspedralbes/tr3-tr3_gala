<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    protected $fillable = ['pelicula_id', 'fecha', 'hora'];
    // ...
}