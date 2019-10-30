<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boletos extends Model
{
    protected $table = 'boletos';
    protected $fillable = [
    
             
           'numero',
           'aciento_numero',
           'vuelo_id',
           'user_id',


    ];

}
