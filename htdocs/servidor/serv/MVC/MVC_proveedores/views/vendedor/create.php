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
<form action="index.php?accion=guardar&evento=crear&tabla=vendedor" method="POST">
  <div class="form-group">
    <label for="numvend">Numero de vendedor </label>
    <input type="text" required class="form-control" id="numvend" name="numvend" aria-describedby="numvend" placeholder="Introduce vendedor" value=<?= $_SESSION["datos"]["numvend"] ?? ""; ?>>
    <?= isset($errores['numvend']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numvend") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="nomvend">Nombre </label>
    <input type="text" class="form-control" id="nomvend" name="nomvend" placeholder="Introduce nombre vendedor" value=<?= $_SESSION["datos"]["nomvend"] ?? ""; ?>>
    <?= isset($errores['nomvend']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nomvend") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="nombrecomer">Nombre comercio </label>
    <input type="text" class="form-control" id="nombrecomer" name="nombrecomer" placeholder="Introduce nombre comercio" value=<?= $_SESSION["datos"]["nombrecomer"] ?? ""; ?>>
    <?= isset($errores['nombrecomer']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nombrecomer") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="telefono">Telefono </label>
    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduce telefono" value=<?= $_SESSION["datos"]["telefono"] ?? ""; ?>>
    <?= isset($errores['telefono']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "telefono") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="calle">Calle </label>
    <input type="text" class="form-control" id="calle" name="calle" placeholder="Introduce calle" value=<?= $_SESSION["datos"]["calle"] ?? ""; ?>>
    <?= isset($errores['calle']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "calle") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="ciudad">Ciudad </label>
    <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Introduce ciudad" value=<?= $_SESSION["datos"]["ciudad"] ?? ""; ?>>
    <?= isset($errores['ciudad']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "ciudad") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="provincia">Provincia </label>
    <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Introduce provincia" value=<?= $_SESSION["datos"]["provincia"] ?? ""; ?>>
    <?= isset($errores['provincia']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "provincia") . "</div>" : ""; ?>
  </div>
  <div class="form-group">
    <label for="cod_postal">Codigo Postal </label>
    <input type="text" class="form-control" id="cod_postal" name="cod_postal" placeholder="Introduce codigo postal" value=<?= $_SESSION["datos"]["cod_postal"] ?? ""; ?>>
    <?= isset($errores['cod_postal']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "cod_postal") . "</div>" : ""; ?>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>

<?php
$_SESSION = [];
?>