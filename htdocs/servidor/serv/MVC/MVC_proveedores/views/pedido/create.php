<?php
require_once "controllers/vendedoresController.php";

$controlador = new vendedoresController();
$vendedores = $controlador->listar();

$cadena = (isset($_REQUEST["error"])) ? "Error, ha fallado la inserción" : "";
$visibilidad = (isset($_REQUEST["error"])) ? "visible" : "invisible";
?>
<div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
<form action="index.php?accion=guardar&evento=crear&tabla=pedido" method="POST">
  <div class="form-group">
    <label for="pedido">Numero de Pedido </label>
    <input type="text" required class="form-control" id="numpedido" name="numpedido" aria-describedby="numpedido" placeholder="Introduce pedido">
    <small id="pedido" class="form-text text-muted">Compartir tu pedido lo hace menos seguro.</small>
  </div>
  <div class="form-group">
    <label for="numvend">Numero de Vendedor </label>
    <select class="form-control" id="numvend" name="numvend">
      <?php
      foreach ($vendedores as $vendedor) :
        echo "<option value={$vendedor['numvend']}>{$vendedor['numvend']} - {$vendedor['nomvend']}</option>";
      endforeach
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="fecha">Fecha </label>
    <input type="date" class="form-control" name="fecha" id="fecha" placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2030-12-31">
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>