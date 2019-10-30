<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aerolinea extends Model
{
    
    protected $table = 'aerolinea';

    protected $fillable = [
        'id',
        'nombre',
        'estado'
    ];
}
