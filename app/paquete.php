<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    protected $table = 'paquetes';

    protected $fillable = [
        'id',
        'imagen',
        'hotel_id',
        'aerolinea_id',
        'precio_paquete',      
        'descripcion'
    ];

}
