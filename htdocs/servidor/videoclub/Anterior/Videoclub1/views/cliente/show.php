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
    <h5 class="card-title">Cliente: ID: <?= $cliente->id ?> Nombre: <?= $cliente->nombre ?></h5>
    <p class="card-text">
      DNI: <?= $cliente->dni ?>
      Nombre: <?= $cliente->nombre ?>
      Primer Apellido: <?= $cliente->apellido1 ?>
      <?php
      $cliente->apellido2 != "" ?: "Segundo Apellido:" . $cliente->apellido2;
      ?>
    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>