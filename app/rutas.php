<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rutas extends Model
{
    protected $table = 'rutas';

    protected $fillable = [
        'id',
        'pais1_id',
        'pais2_id',
        'precio',
        'estado'
    ];

   
}
