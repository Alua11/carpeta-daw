<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="assets/css/404.css" rel="stylesheet">

</head>

<body>
  <div class="conteiner-fluid bg-primary  p-2 mb-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" style="padding-right: 4%" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown" style="margin-right: 30px">
              <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Productos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?accion=crear&tabla=producto">Añadir</a></li>
                <li><a class="dropdown-item" href="index.php?accion=listar&tabla=producto">Listar</a></li>
                <li><a class="dropdown-item" href="index.php?accion=buscar&tabla=producto">Buscar</a></li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Clientes
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?accion=crear&tabla=cliente">Añadir</a></li>
                <li><a class="dropdown-item" href="index.php?accion=listar&tabla=cliente">Listar</a></li>
                <li><a class="dropdown-item" href="index.php?accion=buscar&tabla=cliente">Buscar</a></li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li>
              <a class="nav-link m-5 mt-0 mb-0 btn btn-secondary" href="index.php?accion=guardarBBDD&tabla=bbdd">
                Guardar
              </a>
            </li>
          </ul>
        </div>
    </nav>
  </div>
  <div class="conteiner-fluid">