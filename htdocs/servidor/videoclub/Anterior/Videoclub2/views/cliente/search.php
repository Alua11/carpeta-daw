<?php
require_once "controllers/clientesController.php";
$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new ClientesController();

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
      $clientes = $controlador->buscar($campo, $metodoBusqueda, $dato);
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
    <label for="metodoBusqueda">Elegir metodo de busqueda</label>
    <select class="form-control" name="metodoBusqueda">
      <option value="inicio">Empieza por...</option>
      <option value="final">Acaba por...</option>
      <option selected value="contiene">Contiene...</option>
      <option value="igual">Es igual a...</option>
    </select>
  </div>
  <div class="form-group">
    <label for="dato">Buscar</label>
    <input type="text" required class="form-control" id="dato" name="dato" value="<?= $dato ?>" placeholder="Buscar...">
  </div>
  <button type="submit" class="btn btn-success" name="filtrar">Buscar</button>
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
      </tr>
    </thead>
    <tbody>
      <?php foreach ($clientes as $cliente) :
        $id = $cliente["id"];
      ?>
        <tr>
          <th scope="row"><?= $id ?></th>
          <td><?= $cliente["dni"] ?></td>
          <td><?= $cliente["nombre"] ?></td>
          <td><?= $cliente["apellido1"] ?></td>
          <td><?= $cliente["apellido2"] ?></td>
          <td><a class="btn btn-danger" href="index.php?accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
          <td><a class="btn btn-success" href="index.php?accion=editar&id=<?= $id ?>"><i class="fa fa-pencil"></i>Editar</a></td>
        </tr>
      <?php
      endforeach;
      ?>
    </tbody>
  </table>
<?php
}
?>