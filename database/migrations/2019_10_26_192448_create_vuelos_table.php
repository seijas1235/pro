<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_vuelo');
            $table->integer('acientos');
            $table->integer('ocupado')->nullable()->default(0);
            $table->unsignedInteger('pais1_id');
            $table->foreign('pais1_id')->references('id')->on('pais')->onDelete('cascade');
            
            $table->unsignedInteger('pais2_id');
            $table->foreign('pais2_id')->references('id')->on('pais')->onDelete('cascade');
           
            $table->decimal('precio');

            $table->unsignedInteger('aerolinea_id');
            $table->foreign('aerolinea_id')->references('id')->on('aerolinea')->onDelete('cascade');
            $table->date('fecha_salida');
            
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vuelos');
    }
}
