<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitaciones';
    protected $fillable = [
    
        'imagen',
        'nombre_habitacion',
        'precio',
        'descripcion',
        'fecha_entrada',
        'fecha_salida',
        'user_id',
        'hotel_id',


    ];
}
