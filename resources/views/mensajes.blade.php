@extends('template')

@section('content')
  <div class="container">
    <h1 class="my-3">{{$proceso}}</h1>
    <br>
    @if($error === 0)
      <div class="alert alert-success">{{$mensaje}}</div>
    @else
      <div class="alert alert-danger">{{$mensaje}}</div>
    @endif
  </div>
@stop