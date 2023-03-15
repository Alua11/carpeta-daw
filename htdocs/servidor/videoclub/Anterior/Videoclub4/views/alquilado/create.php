<?php
require_once "assets/php/funciones.php";
require_once "controllers/clientesController.php";
require_once "controllers/productosController.php";

$controladorCli = new ClientesController();
$clientes = $controladorCli->listar();

$controladorPro = new ProductosController();
$productos = $controladorPro->listar();

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
<form action="index.php?accion=guardar&evento=crear&tabla=alquiler" method="POST">
  <div class="form-group">
    <label for="id_cliente">Cliente </label>
    <select class="form-control" id="id_cliente" name="id_cliente">
      <?php
      foreach ($clientes as $cliente) :
        echo "<option value={$cliente['id_cliente']}>{$cliente['id_cliente']} - {$cliente['nombre']}</option>";
      endforeach
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="id_producto">producto </label>
    <select class="form-control" id="id_producto" name="id_producto">
      <?php
      foreach ($productos as $producto) :
        echo "<option value={$producto['id_producto']}>{$producto['id_producto']} - {$producto['nombre']}</option>";
      endforeach
      ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>

<?php
$_SESSION = [];
?>