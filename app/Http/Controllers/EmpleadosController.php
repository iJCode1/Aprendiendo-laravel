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

    // Método que retorna una vista
    public function nomina1($nombre, $diast){
        $pagod = 120;
        $nomina = $diast * $pagod;
        // return view('empleado1'); //Busca la vista llamada 'empleados1.php'

        // En el caso de requerir envíar parametros se puede hacer de la siguiente forma
        
        // Forma 1:
        // return view('empleados1', compact('nombre', 'diast', 'pagod', 'nomina'));

        // Forma 2:
        // return view('empleados1', ['nombre'=>$nombre, 'diast'=>$diast, 'pagod'=>$pagod, 'nomina'=>$nomina]);

        // Forma 3:
        return view('empleados1')
        ->with('nombre', $nombre)
        ->with('pagod', $pagod)
        ->with('diast', $diast)
        ->with('nomina', $nomina);
    }

    public function nomina2($nombre, $diast){
        $pagod = 100;
        $nomina = $diast * $pagod;

        return view('empleados2')
        ->with('nombre', $nombre)
        ->with('pagod', $pagod)
        ->with('diast', $diast)
        ->with('nomina', $nomina);
    }

    // Se crea método para salir
    public function salir(){
        return "Salir";
    }

    // Método para vista 'bootstrap'
    public function bootstrap(){
        return view('bootstrap');
    }

    // Método para las 2 vistas que usan la plantilla
    public function view1(){
        return view('view1');
    }
    public function view2(){
        return view('view2');
    }
}
