<?php
require_once "assets/php/funciones.php";
require_once "controllers/vendedoresController.php";
//recoger datos
if (!isset($_REQUEST["id"])) header('location:index.php?accion=listar&tabla=vendedor');
$id = $_REQUEST["id"];
$controlador = new VendedoresController();
$vendedor = $controlador->ver($id);

$errores = [];
$datos = [];
$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;

if ($vendedor == null) {
  $visibilidad = "visbility";
  $mensaje = "Vendedor con id: {$id} no existe. Por favor vuelva a la pagina anterior";
  $clase = "alert alert-danger";
  $mostrarForm = false;
}

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "editar") {
  $visibilidad = "visbility";
  $mensaje = "Vendedor con numero de vendedor {$id} Modificado con éxito";
  if (isset($_REQUEST["error"])) {
    $errores = $_SESSION["errores"] ?? [];
    $datos = $_SESSION["datos"] ?? [];
    $clase = "alert alert-danger";
    $mensaje =  "Atención, han ocurrido errores";
  }
}
?>
<div class="alert <?= $clase ?> <?= $visibilidad ?>"><?= $mensaje ?></div>
<?php
if ($mostrarForm) {
?>
  <form action="index.php?accion=guardar&evento=editar&tabla=vendedor" method="POST">
    <div class="form-group">
      <label for="numvend">Numero de vendedor <?= $id ?></label>
      <input type="hidden" required class="form-control" id="numvend" name="numvend" aria-describedby="numvend" placeholder="Introduce vendedor" value=<?= $vendedor->numvend ?>>
      <?= isset($errores['numvend']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numvend") . "</div>" : ""; ?>
    </div>
    <div class="form-group">
      <label for="nomvend">Nombre </label>
      <input type="text" class="form-control" id="nomvend" name="nomvend" placeholder="Introduce nombre vendedor" value="<?= $vendedor->nomvend ?>">
      <?= isset($errores['nomvend']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nomvend") . "</div>" : ""; ?>
    </div>
    <div class="form-group">
      <label for="nombrecomer">Nombre comercio </label>
      <input type="text" class="form-control" id="nombrecomer" name="nombrecomer" placeholder="Introduce nombre comercio" value="<?= $vendedor->nombrecomer ?>">
      <?= isset($errores['nombrecomer']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nombrecomer") . "</div>" : ""; ?>
    </div>
    <div class="form-group">
      <label for="telefono">Telefono </label>
      <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduce telefono" value="<?= $vendedor->telefono ?>">
      <?= isset($errores['telefono']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "telefono") . "</div>" : ""; ?>
    </div>
    <div class="form-group">
      <label for="calle">Calle </label>
      <input type="text" class="form-control" id="calle" name="calle" placeholder="Introduce calle" value="<?= $vendedor->calle ?>">
      <?= isset($errores['calle']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "calle") . "</div>" : ""; ?>
    </div>
    <div class="form-group">
      <label for="ciudad">Ciudad </label>
      <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Introduce ciudad" value="<?= $vendedor->ciudad ?>">
      <?= isset($errores['ciudad']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "ciudad") . "</div>" : ""; ?>
    </div>
    <div class="form-group">
      <label for="provincia">Provincia </label>
      <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Introduce provincia" value="<?= $vendedor->provincia ?>">
      <?= isset($errores['provincia']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "provincia") . "</div>" : ""; ?>
    </div>
    <div class="form-group">
      <label for="cod_postal">Codigo Postal </label>
      <input type="text" class="form-control" id="cod_postal" name="cod_postal" placeholder="Introduce codigo postal" value="<?= $vendedor->cod_postal ?>">
      <?= isset($errores['cod_postal']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "cod_postal") . "</div>" : ""; ?>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php">Cancelar</a>
  </form>
<?php
} else {
?>
  <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
<?php
}
