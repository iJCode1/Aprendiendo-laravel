<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;
use App\Models\departamentos;
use App\Models\nomina;
use Illuminate\Support\Facades\Session;

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
        // Obteniendo el último ide para asignarlo automáticamente
        $consulta = empleados::withTrashed()->orderBy('ide', 'DESC')->get();
        $count = count($consulta);

        if($count === 0){
            $ideSiguiente = 1;
        }else{
            $ideSiguiente = $consulta[0]->ide+1;
        }

        $departamentos = departamentos::orderBy('nombre')->get();
        return view('altaempleado')
               ->with("ideSiguiente", $ideSiguiente)
               ->with('departamentos', $departamentos)
               ->with('error', 0);
        
        return $consulta;
    }

    public function guardarempleado(Request $request){
        $nombre = $request->nombre;
        $sexo = $request->sexo;

        // Las validaciones se hacen de izquierda a derecha
        $this->validate($request, [
            // 'ide' => 'required|numeric',
            // 'ide' => 'required|regex: /^[E][M][P]-[0-9]{5}$/',
            'nombre' => 'required|regex: /^[A-Z][A-Z,a-z,\s, á, é, í, ó, ú, ü]+$/',
            'apellido' => 'required|regex: /^[A-Z][A-Z, a-z, \s, á, é, í, ó, ú, ü]+$/',
            // 'precio' => 'required|regex: /^[0-9]+[.][0-9]{2}$/',
            'email' => 'required|email',
            'celular' => 'required|regex: /^[0-9]{10}$/',
            'img' => 'image|mimes:gif,jpeg,png'
        ]);

        // Se prepara la imágen para ser almacenada dentro de la carpeta 'archivos'
        $file = $request->file('img'); // Se obtiene la imagen
        if($file!= ""){ // Si la imagen es diferente de vacio
            $img = $file->getClientOriginalName(); // Se obtiene el nombre de la imagen
            $img2 = time(). '-' . $img; // Se concatena el nombre de la imagen
            \Storage::disk('local')->put($img2, \File::get($file));
        }else{
            $img2 = 'sinFoto.png';
        }

        // Si alguna validación manda un error, ya no se ejecuta lo demas. Se queda a la espera a que se corrija todo
        echo("Las validaciones fueron correctas! ");
        if($sexo === 'M'){
            echo("Bienvenido al sitio $nombre!");
        }else{
            echo("Bienvenida al sitio $nombre!");
        }

        $empleados = new empleados;
        $empleados->ide = $request->ide;
        $empleados->nombre = $request->nombre;
        $empleados->apellido = $request->apellido;
        $empleados->email = $request->email;
        $empleados->celular = $request->celular;
        $empleados->sexo = $request->sexo;
        $empleados->descripcion = $request->descripcion;
        $empleados->idd = $request->idd;
        $empleados->img = $img2;
        $empleados->save();

        Session::flash('mensaje', "La alta de $request->nombre $request->apellido ha sido satisfactoria!");
        Session::flash('tipoDeMensaje', "satisfactorio");
        return redirect()->route('reporteempleados');
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

        // Forzar una eliminación (baja física)
        /*empleados::find(1)->forceDelete();
        return "Empleado eliminado forzadamente!";*/

        /*empleados::create(
            ['ide' => 6, 'nombre' => "Cristian", 'apellido' => "Gutierrez", 'email' => 'Cristian1@hotmail.com', 'celular' => '7228956473', 'sexo' => 'M', 'descripcion' => "Es muy estudioso", 'idd' => 2],
        );
        return "Inserción completa";*/

        // Consultas

        // Consulta todos los registros de la tabla
        $consulta = empleados::all();

        // Consulta con una condición (donde valor de sexo sea 'M')
        $consulta = empleados::where('sexo', 'M')->get();

        // Consulta con condición númerica dentro de un rango
        // El anidamiento de 2 o más 'where' funciona como un 'AND'
        $consulta = empleados::where('edad', '>=', 20)
                               ->where('edad', '<=', 25)
                               ->get();
        // Forma 2
        $consulta = empleados::whereBetween('edad', [20, 25])->get();

        // Consulta con 'where' y 'orwhere' esté ultimo es como un 'OR'
        $consulta = empleados::where('sexo', "F")
                               ->orwhere('salario', '>=', 4500)
                               ->get();

        // Consultar los registrios que tengan una serie de valores posibles y se ordenan
        $consulta = empleados::whereIn('ide', [2, 3, 4])
                               ->orderBy('nombre')
                               ->get();

        // Hacer una consulta y solo obtener los primeros 'n' resultados
        $consulta = empleados::where('salario', '>=', 1000)
                               ->where('salario', '<=', 4000)
                               ->take(2)
                               ->get();

        // Hacer consulta pero solo obtener los valores de ciertos campos
        $consulta = empleados::select(['nombre', 'sexo', 'salario'])
                               ->where('edad', '>=', 24)
                               ->get();

        // Hacer una consulta donde el valor de un campo contenga una subcadena indicada
        $consulta = empleados::where('apellido', 'LIKE', '%me%')
                               ->get();
        
        // Hacer una consulta donde se sumen los valores de un campo (registros donde su 'sexo' sea 'F')
        $consulta = empleados::where('sexo', 'F')
                               ->sum('salario');

        // Consulta donde se aplica una agrupación (por sexo) y se muestra una sumatoría
        $consulta = empleados::groupBy('sexo')
                               ->selectRaw("sexo, sum(salario) as SalarioFinal")
                               ->get();

        // Hacer una consulta pero con una sumatoria
        $consulta = empleados::groupBy('sexo')
                               ->selectRaw("sexo, count(*) as CuantosHay")
                               ->get();

        // Hacer una consulta con join a otra tabla de la BD
        // Ejemplo con sql normal
        /*
            $sql = "SELECT e.ide, e.nombre, d.nombre as departamento, e.edad
                    from empleados AS e
                    INNER JOIN departamentos AS d ON d.idd = e.idd
                    WHERE e.edad >= 22"
        */
        // Implementación con Eloquent
        $consulta = empleados::join("departamentos", "empleados.idd", "=", "departamentos.idd")
                               ->select("empleados.ide", "empleados.nombre", "departamentos.nombre AS departamento", "empleados.edad")
                               ->where("empleados.edad", ">=", 22)
                               ->get();

        // Contar cuantos reultados se arrojaron
        $contador = count($consulta); // 3

        return $consulta;
    }

    public function reporteempleados(){
        
        $empleados = empleados::withTrashed()->join("departamentos", "empleados.idd", "=", "departamentos.idd")
                               ->select("empleados.ide", "empleados.nombre", "empleados.apellido", "empleados.email", "departamentos.nombre AS depa", "empleados.deleted_at AS deleted", "empleados.img")
                               ->orderBy("empleados.nombre")
                               ->get();
        // return $consulta;
        return view('reporteempleados')
               ->with("empleados", $empleados)
               ->with('error', 0);
    }

    // Baja lógica
    public function desactivarempleado($ide){
        empleados::find($ide)
                   ->delete();
        
        Session::flash('mensaje', 'El empleado ha sido desactivado correctamente');
        Session::flash('tipoDeMensaje', "satisfactorio");
        return redirect()->route('reporteempleados');
    }

    public function activarempleado($ide){
        empleados::withTrashed()->find($ide)->restore();
        
        Session::flash('mensaje', "El empleado ha sido activado correctamente!");
        Session::flash('tipoDeMensaje', "satisfactorio");
        return redirect()->route('reporteempleados');
    }

    // Baja física
    public function borrarempleado($ide){

        // Validar que ese 'empleado' no tenga transacciones en otras tablas
        // En caso de tener, no se puede eliminar completamente
        $consulta = nomina::where('ide', "=", $ide)
                            ->get();
        
        $cuantos = count($consulta);

        if($cuantos === 0){ // Si no tiene transacciones
            empleados::withTrashed()->find($ide)->forceDelete();
            
            Session::flash('mensaje', "El empleado ha sido eliminado correctamente");
            Session::flash('tipoDeMensaje', "satisfactorio");
            return redirect()->route('reporteempleados');
        }else{ // Si tiene transacciones
            Session::flash('mensaje', "El empleado no ha sido eliminado por que cuenta con transacciones en otras tablas");
            Session::flash('tipoDeMensaje', "error");
            return redirect()->route('reporteempleados');
        }
    }

    // Modificar empleado
    public function modificarempleado($ide){
        $consulta = empleados::withTrashed()->join('departamentos', 'empleados.idd', '=', 'departamentos.idd')
                               ->select('empleados.ide', 'empleados.nombre', 'empleados.apellido', 'empleados.sexo', 'empleados.celular',
                               'departamentos.nombre as depa', 'empleados.email', 'empleados.idd', 'empleados.descripcion', 'empleados.img')
                               ->where('ide', $ide)
                               ->get();
        
        $departamentos = departamentos::all();

       
        return view('modificarempleado')
               ->with('empleado', $consulta[0])
               ->with('departamentos', $departamentos);
    }

    // Guardar cambios de empleado modificado
    public function guardarcambios(Request $request){

        $this->validate($request, [
            'nombre' => 'required|regex: /^[A-Z][A-Z,a-z,\s, á, é, í, ó, ú, ü]+$/',
            'apellido' => 'required|regex: /^[A-Z][A-Z, a-z, \s, á, é, í, ó, ú, ü]+$/',
            'email' => 'required|email',
            'celular' => 'required|regex: /^[0-9]{10}$/',
            'img' => 'image|mimes:gif,jpeg,png'
        ]);

        // Se prepara la imágen para ser almacenada dentro de la carpeta 'archivos'
        $file = $request->file('img'); // Se obtiene la imagen

        if($file!= ""){ // Si la imagen es diferente de vacio
            $img = $file->getClientOriginalName(); // Se obtiene el nombre de la imagen
            $img2 = time(). '-' . $img; // Se concatena el nombre de la imagen
            \Storage::disk('local')->put($img2, \File::get($file));
        }

        $empleado = empleados::withTrashed()->find($request->ide);
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->email = $request->email;
        $empleado->celular = $request->celular;
        $empleado->sexo = $request->sexo;
        $empleado->idd = $request->idd;
        $empleado->descripcion = $request->descripcion;
        if($file!= ""){ // Si $file es diferente de vacio, es decir, se cambio la imagen... la actualiza en la BD
            $empleado->img = $img2;
        }
        $empleado->save();

        Session::flash('mensaje', "Los datos del empleado se han modificado correctamente");
        Session::flash('tipoDeMensaje', "satisfactorio");
        return redirect()->route('reporteempleados');
    }

}
