<?php
require_once "controllers/clientesController.php";
//recoger datos
if (!isset($_REQUEST["id"])) header('location:index.php');
$id = $_REQUEST["id"];
$controlador = new ClientesController();
$cliente = $controlador->ver($id);

$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($cliente == null) {
  $visibilidad = "visbility";
  $mensaje = "El cliente con id: {$id} no existe. Por favor vuelva a la pagina anterior";
  $clase = "alert alert-danger";
  $mostrarForm = false;
}

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "editar") {
  $visibilidad = "vibility";
  $mensaje = "Cliente con numero {$id} Modificado con éxito";
  if (isset($_REQUEST["error"])) {
    $mensaje = "No se ha podido modificar el cliente numero {$id}";
    $clase = "alert alert-danger";
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
<?php
if ($mostrarForm) {
?>
  <form action="index.php?accion=guardar&evento=editar&tabla=cliente" method="POST">
    <input type="hidden" id="idAntiguo" name="idAntiguo" value="<?= $cliente->getID() ?>">
    <input type="hidden" id="dni" name="dni" value="<?= $cliente->getDNI() ?>">
    <div class="form-group">
      <label for="nombre">Nombre </label>
      <input type="text" required class="form-control" id="nombre" name="nombre" value="<?= $cliente->getNombre() ?>" aria-describedby="nombre" placeholder="Introduce el nombre">
    </div>
    <div class="form-group">
      <label for="apellido1">Primer apellido </label>
      <input type="text" required class="form-control" id="apellido1" name="apellido1" value="<?= $cliente->getApellido1() ?>" placeholder="Introduce el Primer Apellido">
    </div>
    <div class="form-group">
      <label for="apellido2">Segundo apellido </label>
      <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?= $cliente->getApellido2() ?>" placeholder="Introduce el Segundo Apellido">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php?accion=listar&tabla=cliente">Cancelar</a>
  </form>
<?php
} else {
?>
  <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
<?php
}
