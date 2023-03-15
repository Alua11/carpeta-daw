<?php
require_once "controllers/clientesController.php";
if (!isset($_REQUEST['id'])) {
  header("location:index.php");
}
$id = $_REQUEST['id'];
$controlador = new ClientesController();
$cliente = $controlador->ver($id);
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Cliente: ID: <?= $cliente->getID() ?> Nombre: <?= $cliente->getNombre() ?></h5>
    <p class="card-text">
      DNI: <?= $cliente->getDNI() ?>
      Nombre: <?= $cliente->getNombre() ?>
      Primer Apellido: <?= $cliente->getApellido1() ?>
      <?= ($cliente->getApellido2() == "" || $cliente->getApellido2() == NULL) ? "" : "<br>Segundo Apellido: " . $cliente->getApellido2(); ?>
    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>