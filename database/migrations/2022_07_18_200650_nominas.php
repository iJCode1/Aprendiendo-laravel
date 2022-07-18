<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nominas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creación de la tabla
        Schema::create('nominas', function(Blueprint $table){
            $table->increments('idn');
            $table->date('fecha');
            $table->float('monto');
            $table->integer('diast');

            $table->integer('ide')->unsigned();
            $table->foreign('ide')->references('ide')->on('empleados');

            $table->rememberToken();
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
        // Eliminar tabla
        Schema::drop('nominas');
    }
}
