<?php
require_once "controllers/productosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new ProductosController();
$texto = "";

if (isset($_REQUEST["evento"])) {
  $mostrarDatos = true;
  switch ($_REQUEST["evento"]) {
    case "todos":
      $piezas = $controlador->listar();
      $mostrarDatos = true;
      break;
    case "filtrar":
      $texto = ($_REQUEST["busqueda"]) ?? "";
      $piezas = $controlador->buscar($texto);
      break;
    case "borrar":
      $visibilidad = "visibility";
      $mostrarDatos = true;
      $clase = "alert alert-success";
      //Mejorar y poner el nombre/usuario
      $mensaje = "La pieza con id: {$_REQUEST['id']} Borrado correctamente";
      if (isset($_REQUEST["error"])) {
        $clase = "alert alert-danger ";
        $mensaje = "ERROR!!! No se ha podido borrar la pieza con Numero de Pieza: {$_REQUEST['id']}";
      }
      break;
  }
}

?>
<div class="w-75" style="margin: 0 auto">

<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>

<form action="index.php?accion=buscar&tabla=producto&evento=filtrar" method="POST">
  <div class="form-group mt-5 mb-4">
    <label for="busqueda">Buscar producto</label>
    <input type="text" required class="form-control" id="busqueda" name="busqueda" value="<?= $texto ?>" placeholder="Buscar por nombre">
  </div>
  <button type="submit" class="btn btn-primary mb-3" name="Filtrar">Buscar</button>
</form>

<?php
if ($mostrarDatos) {
?>
  <table class="table table-light table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Precio</th>
        <th scope="col">Genero</th>
        <th scope="col">Tipo</th>
        <th scope="col">Plataforma</th>
        <th scope="col">Idioma</th>
        <th scope="col">Duracion</th>
        <th></th>
        <th></th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($piezas as $producto) :
        $id = $producto->getNombre();
      ?>
        <tr>
          <td><?= $producto->getID(); ?></td>
          <td><?= $producto->getNombre(); ?></td>
          <td><?= $producto->getPrecio(); ?></td>
          <td><?= $producto->getGenero(); ?></td>
          <td><?= $producto->getTipo(); ?></td>
          <td><?= $producto->getPlataforma(); ?></td>
          <td><?= $producto->getIdioma(); ?></td>
          <td><?= $producto->getDuracion(); ?></td>
          <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=producto&id=<?= $producto->getID(); ?>"><i class="fa fa-trash"></i> Borrar</a></td>
          <td><a class="btn btn-success" href="index.php?accion=editar&tabla=producto&id=<?= $producto->getID(); ?>"><i class="fa fa-pencil"></i> Editar</a></td>
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