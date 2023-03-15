<?php
require_once "controllers/clientesController.php";
require_once "controllers/alquiladosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new ClientesController();
$controladorA = new AlquiladosController();
$clientes = $controlador->listar();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";

  $mensaje = "El cliente numero: {$_REQUEST['id']} se ha borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar el cliente numero: {$_REQUEST['id']}";
  }
}
?>

<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>


<table class="table table-light table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID Cliente </th>
      <th scope="col">DNI </th>
      <th scope="col">Nombre </th>
      <th scope="col">Primer Apellido </th>
      <th scope="col">Segundo Apellido </th>
      <th></th>
      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($clientes as $cliente) :
      $id = $cliente->getID();
    ?>
      <tr>
        <td><?= $id ?></td>
        <td><?= $cliente->getDNI() ?></td>
        <td><?= $cliente->getNombre() ?></td>
        <td><?= $cliente->getApellido1() ?></td>
        <td><?= $cliente->getApellido2() ?></td>
        <?php
        if (count($controladorA->buscar("id_cliente", $id)) <= 0) {
        ?>
          <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=cliente&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
        <?php
        } else {
          echo "<td></td>";
        }
        ?>
        <td><a class="btn btn-success" href="index.php?accion=editar&tabla=cliente&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
        <td><a class="btn btn-warning" href="index.php?accion=alquileresCliente&tabla=cliente&id=<?= $id ?>"><i class="fa fa-pencil"></i> Alquileres</a></td>
      </tr>
    <?php
    endforeach;

    ?>
  </tbody>
</table>