<?php
require_once "controllers/preciosumController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new PreciosumController();
$lista = $controlador->listar();

/* if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  
  $mensaje = "La pieza  con Numero de Pieza: {$_REQUEST['id']} Borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar la pieza con Numero de Pieza: {$_REQUEST['id']}";
  }
} */
?>
<div class="<?= $clase ?>" role="alert">
  <!-- <?= $mensaje ?> -->
  Ya hare que esto se ve mejor
</div>


<table class="table  table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">Numero de Pieza</th>
      <th scope="col">Numero de Vendedor</th>
      <th scope="col">Precio Unidad</th>
      <th scope="col">Diassum</th>
      <th scope="col">Descuento</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($lista as $elemento) :
    ?>
      <tr>
        <td><?= $elemento["numpieza"] ?></td>
        <td><?= $elemento["numvend"] ?></td>
        <td><?= $elemento["preciounit"] ?></td>
        <td><?= $elemento["diassum"] ?></td>
        <td><?= $elemento["descuento"] ?></td>
      </tr>
    <?php
    endforeach;

    ?>
  </tbody>
</table>