<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hotel extends Model
{
    protected $table = 'hotel';

    protected $fillable = [
        'id',
        'nombre',
        'imagen',
        'descripcion',
        'pais_id',
        'estado'

    ];

} 
    
