<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    // Creación de métodos del controlador
    public function saludo(){
        return "Hola Mundo!, Soy el método Saludo del controlador de Empleados";
    }

    // Método con parámetros
    public function nomina($diast, $pagod){
        $nomina = $diast * $pagod;
        dd($nomina, $diast, $pagod); // Con dd() podemos obtener el valor de la variables pero el código siguiente ya no se ejecuta.
        return "Tu nomina es de: $nomina, con $diast días trabajados donde se pagaron cada día a $pagod";
    }
}
