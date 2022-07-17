<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;

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
    public function altaempleado(){
        return view('altaempleado');
    }

    public function guardarempleado(Request $request){
        $nombre = $request->nombre;
        $sexo = $request->sexo;

        // Las validaciones se hacen de izquierda a derecha
        $this->validate($request, [
            // 'ide' => 'required|numeric',
            'ide' => 'required|regex: /^[E][M][P]-[0-9]{5}$/',
            'nombre' => 'required|regex: /^[A-Z][A-Z,a-z,\s, á, é, í, ó, ú, ü]+$/',
            'apellido' => 'required|regex: /^[A-Z][A-Z, a-z, \s, á, é, í, ó, ú, ü]+$/',
            // 'precio' => 'required|regex: /^[0-9]+[.][0-9]{2}$/',
            'email' => 'required|email',
            'celular' => 'required|regex: /^[0-9]{10}$/',
        ]);
        // Si alguna validación manda un error, ya no se ejecuta lo demas. Se queda a la espera a que se corrija todo
        echo("Las validaciones fueron correctas! ");

        if($sexo === 'M'){
            echo("Bienvenido al sitio $nombre!");
        }else{
            echo("Bienvenida al sitio $nombre!");
        }

        // dd($request);
        // return $request;
        // return view('view2');
    }

    public function eloquent(){
        // Consulta basica
        // $consulta = empleados::all();
        // return $consulta;

        // Inserción básica: Forma 1
        /*$empleados = new empleados;
        $empleados->ide = 5;
        $empleados->nombre = 'Samuel';
        $empleados->apellido = 'Cortez';
        $empleados->email = 'samu@samu.com';
        $empleados->celular = "7228763451";
        $empleados->sexo = 'M';
        $empleados->descripcion = 'Es un empleado responsable';
        $empleados->idd = 2;
        $empleados->save();*/

        // Inserción básica: Forma 2
        /*$empleados = empleados::create(
            ['ide' => 6, 'nombre' => "Paty", 'apellido' => "Gutierrez", 'email' => 'paty7@paty.com', 'celular' => '7228945623', 'sexo' => 'F', 'descripcion' => "Le gusta leer", 'idd' => 1],
        );*/

        // Modificación de un registro a partir de su identificador 'ide'
        /*$empleados = empleados::find(2);
        $empleados->nombre = "SamuelEditado";
        $empleados->apellido = "MontielEditado";
        $empleados->save();*/

        // Modificación a partir de una o más condiciones (where)
        /*empleados::where('sexo', 'M')
        ->where('idd', '1')
        ->update(['nombre' => 'NombreDeHombre', 'celular' => "2227775555"]);*/
        
        // return 'Modificación realizada';

        // Eliminar un registro a partir de su llave primaria
        // empleados::destroy(2);

        // Eliminar un registro a partir de una busqueda por su 'ide'
        /*$empleados = empleados::find(3);
        $empleados->delete();*/

        // Eliminar uno o más registros que cumplan una o más condiciones
        /*$empleados = empleados::where('sexo', 'F')
        ->where("idd", 1)
        ->delete();*/

        // SoftDeletes
        /*$empleados = empleados::find(1);
        $empleados->delete();
        return "Eliminacion exitosa!";*/

        // Consultar los registros que no tienen baja lógica
        /*$empleados = empleados::all();
        return $empleados;*/

        // Consultar los registros tanto con baja lógica y sin baja lógica (todos)
        /*$empleados = empleados::withTrashed()->get();
        return $empleados;*/

        // Consultar únicamente los registros con baja lógica
        /*$empleados = empleados::onlyTrashed()->get();
        return $empleados;*/

        // Consultar registros que tienen baja lógica pero que cumplan con una o más condiciones establecidas
        /*$empleados = empleados::onlyTrashed()
                     ->where('sexo', 'M')
                     ->get();
        return $empleados;*/

        /*$empleados = empleados::withTrashed()
                     ->where('ide', 1)
                     ->restore();
        return "Empleado restaurado!";*/

        empleados::find(1)->forceDelete();
        return "Empleado eliminado forzadamente!";
    }
}
