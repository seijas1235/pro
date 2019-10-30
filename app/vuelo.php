<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vuelo extends Model
{
    
    protected $table = 'vuelos';

    protected $fillable = [
        'id',
        'no_vuelo',
        'acientos',
        'ocupado',
        'pais1_id',
        'pais2_id',
        'precio',
        'aerolinea_id',
        'fecha_salida',
        'estado'
    ];
}
