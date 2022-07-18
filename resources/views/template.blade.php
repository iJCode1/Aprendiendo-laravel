<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <title>iJCode - Plantilla Blade</title>
</head>
<body>
  
  <!-- Se crea la estructura de la plantilla -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{Route('reporteempleados')}}">iJCode</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{Route('reporteempleados')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Novedades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
            Servicios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Servicio 1</a>
            <a class="dropdown-item" href="#">Servicio 2</a>
            <a class="dropdown-item" href="#">Servicio 3</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Se crea una sección donde se mostrará el contenido de cada página en particular donde se importe está plantilla -->
  <div class="container">
    @yield('content')
  </div>

  <div class="container">
    @yield('content2')
  </div>

  <footer class="footer bg-primary mt-auto py-3">
    <div class="container">
      <span class="text-white">Todos los derechos reservados :)</span>
    </div>
  </footer>

</body>
</html>