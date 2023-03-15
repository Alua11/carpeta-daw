<?php
require_once "controllers/clientesController.php";
require_once "controllers/alquiladosController.php";
$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new ClientesController();
$controladorA = new AlquiladosController();

$campo = "";
$metodoBusqueda = "";
$dato = "";

if (isset($_REQUEST["evento"])) {
  $mostrarDatos = false;
  switch ($_REQUEST["evento"]) {
    case "todos":
      $mostrarDatos = true;
      $clientes = $controlador->listar();
      break;
    case "filtrar":
      $mostrarDatos = true;
      $campo = ($_REQUEST["campo"]) ?? "";
      $metodoBusqueda = ($_REQUEST["metodoBusqueda"]) ?? "";
      $dato = ($_REQUEST["dato"]) ?? "";
      $clientes = $controlador->buscar($campo, $dato);
      break;
    case "borrar":
      $mostrarDatos = true;
      $visibilidad = "visibility";
      $clase = "alert alert-success";

      $mensaje = "El cliente con id {$_REQUEST['id']}: {$_REQUEST['nombre']} Borrado correctamente";
      if (isset($_REQUEST["error"])) {
        $clase = "alert alert-danger ";
        $mensaje = "ERROR!!! No se ha podido borrar el cliente con id: {$_REQUEST['id']}";
      }
      break;
  }
}
?>
<div class="w-75" style="margin: 0 auto">

<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>
<form action="index.php?accion=buscar&evento=filtrar&tabla=cliente" method="POST">
  <div class="form-group">
    <label for="campo">Elegir campo de busqueda</label>
    <select class="form-control" name="campo">
      <option value="id">ID</option>
      <option value="dni">DNI</option>
      <option selected value="nombre">Nombre</option>
      <option value="apellido1">Primer apellido</option>
      <option value="apellido2">Segundo apellido</option>
    </select>
  </div>
  <div class="form-group">
    <label for="dato">Buscar</label>
    <input type="text" required class="form-control" id="dato" name="dato" value="<?= $dato ?>" placeholder="Buscar...">
  </div>
  <button type="submit" class="btn btn-primary" name="filtrar">Buscar</button>
</form>
<!-- Este formulario es para ver todos los datos -->
<form action="index.php?accion=buscar&evento=todos&tabla=cliente" method="POST">
  <button type="submit" class="btn btn-info" name="todos">Ver todos</button>
</form>
<?php
if ($mostrarDatos) {
?>
  <table class="table table-light table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">DNI</th>
        <th scope="col">Nombre</th>
        <th scope="col">Primer Apellido</th>
        <th scope="col">Segundo Apellido</th>
        <th scope="col">Eliminar</th>
        <th scope="col">Editar</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($clientes as $cliente) :
        $id = $cliente->getID();
      ?>
        <tr>
          <th scope="row"><?= $id ?></th>
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
    </div>
<?php
}
?>