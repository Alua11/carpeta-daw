<?php
require_once "controllers/alquiladosController.php";
if (!isset($_REQUEST['id'])) {
  header("location:index.php");
}
$id = $_REQUEST['id'];
$controlador = new AlquiladosController();
$alquiler = $controlador->ver($id);
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Alquiler: <?= $alquiler->id ?></h5>
    <p class="card-text">
      Cliente: <?= $alquiler->id_cliente ?>
      Producto: <?= $alquiler->id_producto ?>
    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>