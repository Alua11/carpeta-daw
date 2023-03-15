<?php
require_once "controllers/piezasController.php";
require_once "controllers/inventariosController.php";
require_once "controllers/linpedController.php";
require_once "controllers/preciosumController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new piezasController();
$piezas = $controlador->listar();

$controladorInv = new InventariosController();
$controladorLin = new LinpedController();
$controladorPresum = new PreciosumController();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  //Mejorar y poner el nombre/usuario
  $mensaje = "La pieza  con Numero de Pieza: {$_REQUEST['id']} Borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar la pieza con Numero de Pieza: {$_REQUEST['id']}";
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>


<table class="table  table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">Numero de Pieza</th>
      <th scope="col">Nombre de Pieza</th>
      <th scope="col">Precio </th>
      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($piezas as $pieza) :
      $id = $pieza["numpieza"];
    ?>
      <tr>
        <td><?= $pieza["numpieza"] ?></td>
        <td><?= $pieza["nompieza"] ?></td>
        <td><?= $pieza["preciovent"] ?></td>
        <?php
        if (count($controladorInv->buscar('NUMpieza', 'igual', $id)) <= 0 && count($controladorLin->buscar($id)) <= 0 && count($controladorPresum->buscar("numpieza", "igual", $id)) <= 0) {
        ?>
          <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=piezas&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
        <?php
        } else {
          echo "<td></td>";
        }
        ?>
        <td><a class="btn btn-success" href="index.php?accion=editar&tabla=piezas&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
      </tr>
    <?php
    endforeach;

    ?>
  </tbody>
</table>