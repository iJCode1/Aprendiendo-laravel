<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iJCode - Empleados</title>
</head>
<body>
  <!-- Usando la estructura de blade -->
  <!-- Para imprimir una variable se usa '{{$nombre}}' -->
  <h2>Los datos del empleado son:</h2>
  <p>Nombre: {{$nombre}}</p>
  <p>Días trabajados: {{$diast}}</p>
  <p>Pago por día: {{$pagod}}</p>
  <p>Nomina: {{$nomina}}</p>

  @if($nomina >= 1000):
    <p>Felicidades! Ganaste más de 1000 pesos</p>
    <img src="{{asset('icons/happy.png')}}" width="200" alt="Imagen feliz"/>
  @elseif($nomina > 700 && $nomina < 1000):
    <p>No te fue tan mal! Ganaste entre 700 y 1000</p>
  @else:
    <p>Lo lamento! Ganaste menos de 700 pesos</p>
    <img src="{{asset('icons/sad.png')}}" width="200" alt="Imagen Triste"/>
  @endif
  <br>
  <!-- Salir de una página -->
  <a href="{{Route('salir')}}">Salir de esta página</a>
</body>
</html>