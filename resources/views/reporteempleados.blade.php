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
      <button type="button" class="btn btn-danger">Eliminar</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop