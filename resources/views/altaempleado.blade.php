<!-- Se indica el template de donde se exportara tanto la estructura como bootrstap en este caso -->
@extends('template')

<!-- Se creá el código que contendra está página -->
<!-- Se debe crear la sección con el nombre que se indico en el template -->
@section('content')

<!-- <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card de la Vista 1</h5>
    <h6 class="card-subtitle mb-2 text-muted">Subtitulo de la vista 1</h6>
    <p class="card-text">Parrafo de la vista 1</p>
    <a href="#" class="card-link">Link de la vista 1</a>
    <a href="#" class="card-link">Otro link de la vista 1</a>
  </div>
</div> -->

<h2 class="text-primary mt-4">Alta del empleado</h2>

<form action="{{Route('guardarempleado')}}" method="POST">
  {{csrf_field()}}
  <div class="well">
    <div class="form-group">
      <label for="ide">Clave empleado:
        @if($errors->first('ide'))
        <p class="text-danger">{{$errors->first('ide')}}</p>
        @endif
      </label>
      <input type="text" name="ide" id="ide" value="{{old('ide')}}" class="form-control" placeholder="Clave empleado" tabindex="1">
    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="nombre">Nombre:
            @if($errors->first('nombre'))
            <p class="text-danger">{{$errors->first('nombre')}}</p>
            @endif
          </label>
          <input type="text" name="nombre" value="{{old('nombre')}}" id="nombre" class="form-control" placeholder="Nombre" tabindex="2">
        </div>
      </div>

      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="apellido">Apellido:
            @if($errors->first('apellido'))
            <p class="text-danger">{{$errors->first('apellido')}}</p>
            @endif
          </label>
          <input type="text" name="apellido" value="{{old('apellido')}}" id="apellido" class="form-control" placeholder="Apellido" tabindex="3">
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="email">Email:
            @if($errors->first('email'))
            <p class="text-danger">{{$errors->first('email')}}</p>
            @endif
          </label>
          <input type="email" name="email" value="{{old('email')}}" id="email" class="form-control" placeholder="Email" tabindex="4">
        </div>
      </div>

      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
          <label for="celular">Celular:
            @if($errors->first('celular'))
            <p class="text-danger">{{$errors->first('celular')}}</p>
            @endif
          </label>
          <input type="text" name="celular" value="{{old('celular')}}" id="celular" class="form-control" placeholder="Celular" tabindex="5">
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <label for="sexo">Sexo:</label>
        <div class="custom-control custom-radio">
          <input type="radio" id="sexo1" name="sexo" value="M" class="custom-control-input" checked="" tabindex="6">
          <label class="custom-control-label" for="sexo1">Masculino</label>
        </div>
        <div class="custom-control custom-radio">
          <input type="radio" id="sexo2" name="sexo" value="F" class="custom-control-input" tabindex="7">
          <label class="custom-control-label" for="sexo2">Femenino</label>
        </div>


      </div>

      <div class="col-xs-6 col-sm-6 col-md-6">

        <div class="form-group">
          <label for="idd">Departamento:
            @if($errors->first('idd'))
            <p class="text-danger">{{$errors->first('idd')}}</p>
            @endif
          </label>
          <select name='idd' class="custom-select" value="{{old('idd')}}" tabindex="8">
            <option selected="">Selecciona un departamento</option>
            <option value="1">Compras</option>
            <option value="2">Ventas</option>
            <option value="3">Producción</option>
          </select>
        </div>

      </div>
    </div>
    <div class="form-group">
      <label for="detalle">Descripción:
        @if($errors->first('detalle'))
          <p class="text-danger">{{$errors->first('detalle')}}</p>
        @endif
      </label>
      <textarea name="detalle" value="{{old('detalle')}}" id="detalle" class="form-control" tabindex="9"></textarea>
    </div>
    <div class="row my-4">
      <div class="col-xs-6 col-md-12"><input type="submit" value="Guardar" class="btn btn-danger btn-block btn-lg" tabindex="10" title="Guardar datos ingresados"></div>
    </div>
  </div>
</form>

@stop