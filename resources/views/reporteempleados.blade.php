@extends('template')

@section('content')
  <h1 class="my-5">Reporte de empleados</h1>
  <a href="{{Route('altaempleado')}}">
    <button type="button" class="btn btn-success mb-3">Dar de alta empleado</button>
  </a>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Clave</th>
      <th scope="col">Nombre Completo</th>
      <th scope="col">Correo</th>
      <th scope="col">Área</th>
      <th scope="col">Operaciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($empleados as $empleado)
    <tr>
      <th scope="row">{{$empleado->ide}}</th>
      <td>{{$empleado->nombre}} {{$empleado->apellido}}</td>
      <td>{{$empleado->email}}</td>
      <td>{{$empleado->depa}}</td>
      <td>
      <button type="button" class="btn btn-warning">Modificar</button>
      @if($empleado->deleted != NULL)
      <a href="{{Route('activarempleado', ['ide'=>$empleado->ide])}}">
        <button type="button" class="btn btn-success">Activar</button>
      </a>
      <a href="{{Route('borrarempleado', ['ide'=>$empleado->ide])}}">
        <button type="button" class="btn btn-secondary">Borrar</button>
      </a>
      @else
      <a href="{{Route('desactivarempleado', ['ide'=>$empleado->ide])}}">
        <button type="button" class="btn btn-danger">Desactivar</button>
      </a>
      @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop