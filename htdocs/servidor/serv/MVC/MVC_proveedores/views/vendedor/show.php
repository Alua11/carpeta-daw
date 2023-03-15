<?php
require_once "controllers/vendedoresController.php";
if (!isset($_REQUEST['id'])) {
  header("location:index.php");
}
$id = $_REQUEST['id'];
$controlador = new VendedoresController();
$vendedor = $controlador->ver($id);
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <p class="card-text">
      Numero: <?= $vendedor->numvend . "<br>" ?>
      Nombre: <?= $vendedor->nomvend ?>
    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>