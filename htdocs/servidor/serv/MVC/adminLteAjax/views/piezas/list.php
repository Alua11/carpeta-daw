<?php
require_once "controllers/piezasController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new piezasController();
$piezas = $controlador->listar();

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
<!-- Button to trigger modal -->
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
  Nueva Pieza
</button>
<div class="<?= $clase?>" <?=$visibilidad?> role="alert">
  <?= $mensaje?>
</div>


<table class="table  table-hover">
<thead class="table-dark">
    <tr>
      <th scope="col">Numero de Pieza</th>
      <th scope="col">Nombre de Pieza</th>
      <th scope="col">Precio </th>
      <th></th><th></th>

    </tr>
  </thead>
  <tbody>
<?php foreach($piezas as $pieza):
        $id=$pieza["numpieza"];
  ?>
    <tr>
      <td><?=$pieza["numpieza"]?></td>
      <td><?=$pieza["nompieza"]?></td>
      <td><?=$pieza["preciovent"]?></td>
      <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=piezas&id=<?=$id?>"><i class="fa fa-trash"></i> Borrar</a></td>
      <td><a class="btn btn-success" href="index.php?accion=editar&tabla=piezas&id=<?=$id?>"><i class="fa fa-pencil"></i> Editar</a></td>
    </tr>
<?php 
    endforeach;

    ?>
  </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Añadir Pieza</h4>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <p class="statusMsg"></p>
        <form id="f_insercion">
          <div class="form-group">
            <label for="pieza">pieza </label>
            <input type="text" required class="form-control" id="numpieza" name="numpieza" aria-describedby="numpieza" placeholder="Introduce pieza" value="<?= $_SESSION["datos"]["numpieza"] ?? "" ?>">
            <small id="pieza" class="form-text text-muted">Compartir tu pieza lo hace menos seguro.</small>
            <?= isset($errores["numpieza"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "numpieza") . '</div>' : ""; ?>
          </div>
          <div class="form-group">
            <label for="nompieza">Nombre </label>
            <input type="text" class="form-control" id="nompieza" name="nompieza" placeholder="Introduce el Nombre de la pieza" value="<?= $_SESSION["datos"]["nompieza"] ?? "" ?>">
            <?= isset($errores["nompieza"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nompieza") . '</div>' : ""; ?>
          </div>
          <div class="form-group">
            <label for="preciovent">Precio de Venta </label>
            <input type="number" min="0" step="any" pattern="^[0-9]+[.,]?([0-9]{0,2})$" class="form-control" id="preciovent" name="preciovent" placeholder="Introduce el Precio" value="<?= $_SESSION["datos"]["preciovent"] ?? "" ?>">
            <?= isset($errores["preciovent"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "preciovent") . '</div>' : ""; ?>
          </div>
          <button type="button"  id="insertar" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
