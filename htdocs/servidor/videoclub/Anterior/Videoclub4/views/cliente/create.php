<?php
require_once "assets/php/funciones.php";

$cadenaErrores = "";
$errores = [];
$datos = [];
$cadena = "";
$visibilidad = "invisible";

if (isset($_REQUEST["error"])) {
  $errores = $_SESSION["errores"] ?? [];
  $datos = $_SESSION["datos"] ?? [];
  $cadena =  "Atención, han ocurrido errores";
  $visibilidad = "visible";
}

?>
<div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
<form action="index.php?accion=guardar&evento=crear&tabla=cliente" method="POST">
  <div class="form-group">
    <label for="dni">DNI </label>
    <input type="text"  required class="form-control" id="dni" name="dni" placeholder="Introduce el dni del cliente" value=<?= $_SESSION["datos"]["dni"] ?? ""; ?>>
    <?= isset($errores['dni']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "dni") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="nombre">Nombre </label>
    <input type="text" required class="form-control" id="nombre" name="nombre" placeholder="Introduce el Nombre del cliente" value=<?= $_SESSION["datos"]["nombre"] ?? ""; ?>>
    <?= isset($errores['nombre']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nombre") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="apellido1">Primer Apellido </label>
    <input type="text" required class="form-control" id="apellido1" name="apellido1" placeholder="Introduce el Precio" value=<?= $_SESSION["datos"]["apellido1"] ?? ""; ?>>
    <?= isset($errores['apellido1']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "apellido1") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="apellido2">Segundo Apellido </label>
    <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Introduce el Precio" value=<?= $_SESSION["datos"]["apellido2"] ?? ""; ?>>
    <?= isset($errores['apellido2']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "apellido2") . "</div>" : ""; ?>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>
