<?php

use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// *********** Creación de rutas ************
Route::get('saludo', [EmpleadosController::class,'saludo']); // La ruta apunta a la función 'saludo' del controlador Empleados

// Ruta con parámetro
Route::get("nomina/{param1}/{param2}", [EmpleadosController::class, 'nomina']);

// Ruta que llama al método que retorna una vista
Route::get("nomina1/{nombre}/{diast}", [EmpleadosController::class, 'nomina1']);

Route::get('nomina2/{nombre}/{diast}', [EmpleadosController::class, 'nomina2']);
Route::get("salir", [EmpleadosController::class, 'salir'])->name('salir');

Route::get('boots', [EmpleadosController::class, 'bootstrap']);

Route::get('altaempleado', [EmpleadosController::class, 'altaempleado'])->name("altaempleado");
Route::post('guardarempleado', [EmpleadosController::class, 'guardarempleado'])->name('guardarempleado');

// Eloquent
Route::get("eloquent", [EmpleadosController::class, 'eloquent'])->name('eloquent');

// Tabla de empleados
Route::get("reporteempleados", [EmpleadosController::class, 'reporteempleados'])->name('reporteempleados');

// Desactivar empleados
Route::get('desactivarempleado/{ide}', [EmpleadosController::class, 'desactivarempleado'])->name("desactivarempleado");

// Activar empleados
Route::get('activarempleado/{ide}', [EmpleadosController::class, 'activarempleado'])->name('activarempleado');

// Borrar (forzado) empleados
Route::get('borrarempleado/{ide}', [EmpleadosController::class, 'borrarempleado'])->name('borrarempleado');

// Modificar empleado
Route::get('modificarempleado/{ide}', [EmpleadosController::class, 'modificarempleado'])->name("modificarempleado");

// Guardar datos de empleado modificado
Route::post('guardarcambios', [EmpleadosController::class, 'guardarcambios'])->name('guardarcambios');

// Formulario de Login
Route::get('login', [LoginController::class, 'login'])->name('login');

// Validar login
Route::post('validarLogin', [LoginController::class, 'validarLogin'])->name('validarLogin');

// Vista principal (una vez logueado)
Route::get('principal', [LoginController::class, 'principal'])->name('principal');

/*
// Las rutas no deberian crearse de la siguiente forma, solo llamadas a métodos de controladores
// Ruta normal - Imprime texto
Route::get('/ruta1', function(){
    return "Soy la ruta 1!";
});

// Ruta normal - Realiza código e imprime mensaje con texto + variable
Route::get('/arearectangulo', function(){
    $base = 5;
    $altura = 10;
    $area = $base * $altura;
    return "La área de un Rectangulo con Base: $base y Altura: $altura = $area";
});

// Ruta normal - Recibe parametros en la ruta
// Los parametros se separan por '/' y deben ir entre '{}'
// Los parametros igual se deben especificar dentro de la función
Route::get('/arearectangulo2/{base}/{altura}', function($base, $altura){
    $area = $base * $altura;
    return "El área de un Rectangulo con Base: $base y Altura: $altura = $area";
});

// Ruta normal - Recibe parametros y puede tener parametros no necesarios y valores por defecto
// Para especificar que un parámetro no es necesario, se coloca un '?' despues del nombre
// Si un parámetro no es necesario, se le debe poner un valor por defecto a la variable en la función
Route::get('/nomina/{diast}/{pagodiario?}', function($diast, $pagodiario = null){
    if($pagodiario == null){
        $pagodiario = 100;
        $nomina = $diast * $pagodiario;
    }else{
        $nomina = $diast * $pagodiario;
    }

    return "La nomina es: $nomina. Trabajaste $diast días y el pago por día es: $pagodiario";
});


// *********** Redireccionamiento en las Rutas ************

// Forma 1: Se crea como si de una ruta se tratará
Route::get('/redireccion1', function(){
    return redirect('/ruta1');
});

// Forma 2: Se hace de forma directa la redirección 
// Route::redirect("ruta", "ruta a donde se hace la redirección");
Route::redirect("/redireccion2", "/ruta1");

// Redireccionamiento con envio de parámetros
Route::redirect("/redireccion3", "/arearectangulo2/7/10");

// Ruta con parámetros y Redireccionamiento
Route::get("/redireccion4/{base}/{altura?}", function($base, $altura = 0){
    return redirect("/arearectangulo2/$base/$altura");
});

// Redirección a una página externa
Route::redirect("/redireccion5", "https://github.com/iJCode1");
*/