<?php

use App\Pais;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds'
     *
     * @return void
     */
    public function run()
    {
       
        Pais::create(['nombre'=>'Belice']);
        Pais::create(['nombre'=>'Costa Rica']);
        Pais::create(['nombre'=>'El Salvador']);
        Pais::create(['nombre'=>'Guatemala ']);
        Pais::create(['nombre'=>'Honduras']);
        Pais::create(['nombre'=>'Nicaragua']);
        Pais::create(['nombre'=>'Panamá ']);


    }
}


