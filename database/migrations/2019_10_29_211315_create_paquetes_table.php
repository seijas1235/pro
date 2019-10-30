<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquetes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('imagen');

            $table->unsignedInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotel')->onDelete('cascade');
            
            $table->unsignedInteger('aerolinea_id');
            $table->foreign('aerolinea_id')->references('id')->on('aerolinea')->onDelete('cascade');
            
            $table->decimal('precio_paquete');
            $table->integer('cantidad');
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
        Schema::dropIfExists('paquetes');
    }
}
