<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\usuarios;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // login
    public function login(){
        return view('login');
    }

    // Validar ingreso
    public function validarLogin(Request $request){
        $this->validate($request, [
            "usuario" => 'required',
            "pasw" => 'required',
        ]);

        // Crear una contraseña encriptada (al momento de registrar un usuario)
        // $password_encriptada = Hash::make($request->pasw);

        // Se consulta si el usuario es activo y existe en la BD
        $consulta = usuarios::where('user', $request->usuario)
                              ->where('activo', "Si")
                              ->get();
        $cuantos = count($consulta);

        // Se valida si es que existe un usuario en la BD y coincide con la contraseña ingresada
        if($cuantos === 1 and Hash::check($request->pasw, $consulta[0]->pasw)){
            Session::put('sessionUsuario', $consulta[0]->nombre .' '. $consulta[0]->apellido);
            Session::put('sessionTipo', $consulta[0]->tipo);
            Session::put('sessionIdu', $consulta[0]->idu);
            return redirect()->route('principal');
        }else{
            Session::flash("mensaje", "El usuario o contraseña no son validos");
            return redirect()->route("login");
        }
    }

    public function principal(){
        // Se obtiene el valor de una sesión (nombre)
        // Si no existe, este retornara un vacio ""
        $sessionIdu = Session('sessionIdu');
        // Se hace la validación si esa sesión tiene un valor
        if($sessionIdu != ""){
            return view('template');
        }else{
            // Significa que no hay una sesión creada por lo que no ha ingresado con sus credenciales
            // Se le redirige a la ruta de 'login'
            Session::flash('mensaje', "Debe iniciar sesión primero");
            return redirect()->route('login');
        }
    }

    public function cerrarsesion(){
        session::forget('sessionUsuario');
        session::forget('sessionTipo');
        session::forget('sessionIdu');
        session::flush();

        Session::flash('mensaje', "Cierre de sesión exitoso!");
        return redirect()->route('login');
    }
}
