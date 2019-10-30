<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('numero');
            $table->string('aciento_numero');
            $table->unsignedInteger('vuelo_id');
            $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('boletos');
    }
}
