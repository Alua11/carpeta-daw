<?php
require_once "controllers/alquiladoController.php";
require_once "controllers/clientesController.php";
require_once "controllers/productosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new AlquiladosController();
$alquileres = $controlador->listar();

$controladorCli = new ClientesController();

$controladorPro = new ProductosController();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";

  $mensaje = "El alquiler numero: {$_REQUEST['id']} se ha borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar el alquiler numero: {$_REQUEST['id']}";
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>


<table class="table table-light table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID Alquiler</th>
      <th scope="col">Nombre Cliente</th>
      <th scope="col">Nombre Producto</th>
      <th scope="col">Fecha Alquiler</th>
      <th scope="col">Fecha devolucion</th>
      <th></th>
      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($alquileres as $alquiler) :
      $id = $alquiler["id"];
    ?>
      <tr>
        <td><?= $id ?></td>
        <td><?= $alquiler["dni"] ?></td>
        <td><?= $alquiler["nombre"] ?></td>
        <td><?= $alquiler["apellido1"] ?></td>
        <td><?= $alquiler["apellido2"] ?></td>
        <?php
        if (count($controladorA->buscar("id_cliente", "igual", $id)) <= 0) {
        ?>
          <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=cliente&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
        <?php
        }
        ?>
        <td><a class="btn btn-success" href="index.php?accion=editar&tabla=cliente&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
      </tr>
    <?php
    endforeach;

    ?>
  </tbody>
</table>