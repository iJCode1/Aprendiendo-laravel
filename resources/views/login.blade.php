@extends('template')

@section('content')
  <div class="container">
    <h1 class="text-primary">Inicio de Sesión</h1>
    <hr>
    <form action="{{Route('validarLogin')}}" method="POST">
      {{csrf_field()}}
      <div class="well">
        <div class="form-group">
          <label for="usuario">Usuario:
            @if($errors->first('usuario'))
              <p class="text-danger">{{$errors->first('usuario')}}</p>
            @endif
          </label>
          <input type="text" name="usuario" id="usario" value="" class="form-control" placeholder="Nombre de usario...">
        </div>
        <div class="form-group">
          <label for="pasw">Password:
            @if($errors->first('pasw'))
              <p class="text-danger">{{$errors->first('pasw')}}</p>
            @endif
          </label>
          <input type="password" name="pasw" id="pasw" value="" class="form-control" placeholder="Contraseña...">
        </div>

        <div class="row">
          <div class="col-xs-6 col-md-6">
            <input type="submit" value="Iniciar" class="btn btn-danger btn-block" title="Iniciar Sesión">
          </div>
        </div>
      </div>
    </form>
    <br>
    <br>
    @if(Session::has('mensaje'))
      <div class="alert alert-danger">{{Session::get('mensaje')}}</div>
    @endif
  </div>
@stop