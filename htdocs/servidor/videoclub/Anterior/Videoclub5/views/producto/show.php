<?php
require_once "controllers/productosController.php";
if (!isset($_REQUEST['id'])){
    header ("location:index.php");
}
$id=$_REQUEST['id'];
$controlador= new ProductosController();
$producto = $controlador->ver($id);
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Producto ID: <?= $producto->getID(); ?> NOMBRE: <?= $producto->getNombre(); ?></h5>
    <p class="card-text">

    </p>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  </div>
</div>