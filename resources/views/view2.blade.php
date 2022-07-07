<!-- Se indica el template de donde se exportara tanto la estructura como bootrstap en este caso -->
@extends('template')

<!-- Se creá el código que contendra está página -->
<!-- Se debe crear la sección con el nombre que se indico en el template -->
@section('content')

<div class="jumbotron">
  <h1 class="display-4">Jumbotron de la Vista 2</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>

@stop

@section('content2')

<p>Soy un parrafo de la sección número 2</p>

@stop