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
            return redirect()->route('principal');
        }else{
            Session::flash("mensaje", "El usuario o contraseña no son validos");
            return redirect()->route("login");
        }
    }

    public function principal(){
        return view('template');
    }
}
