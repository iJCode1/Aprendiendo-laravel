<!-- Se indica el template de donde se exportara tanto la estructura como bootrstap en este caso -->
@extends('template')

<!-- Se creá el código que contendra está página -->
<!-- Se debe crear la sección con el nombre que se indico en el template -->
@section('content')

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card de la Vista 1</h5>
    <h6 class="card-subtitle mb-2 text-muted">Subtitulo de la vista 1</h6>
    <p class="card-text">Parrafo de la vista 1</p>
    <a href="#" class="card-link">Link de la vista 1</a>
    <a href="#" class="card-link">Otro link de la vista 1</a>
  </div>
</div>

@stop