@extends('template')

@section('content')
  <div class="container">
    <h1 class="my-3">Proceso{{$proceso}}</h1>
    <br>
    <div class="alert alert-success">{{$mensaje}}</div>
  </div>
@stop