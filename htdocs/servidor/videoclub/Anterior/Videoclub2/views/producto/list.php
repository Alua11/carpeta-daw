<?php
require_once "controllers/productosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new ProductosController();
$piezas = $controlador->listar();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  //Mejorar y poner el nombre/usuario
  $mensaje = "El producto con id {$_REQUEST['id']} ha sido borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar la pieza con Numero de Pieza: {$_REQUEST['id']}";
  }
}
?>
<div class="w-75" style="margin: 0 auto">
<div class="<?= $clase?>" <?=$visibilidad?> role="alert">
  <?= $mensaje?>
</div>


<table class="table table-light table-hover">
<thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre de producto</th>
      <th scope="col">Precio </th>
      <th></th><th></th>

    </tr>
  </thead>
  <tbody>
<?php foreach($piezas as $producto):
        $id=$producto["id"];
  ?>
    <tr>
      <td><?=$producto["id"]?></td>
      <td><?=$producto["nombre"]?></td>
      <td><?=$producto["precio"]?></td>
      <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=producto&id=<?=$id?>"><i class="fa fa-trash"></i> Borrar</a></td>
      <td><a class="btn btn-success" href="index.php?accion=editar&tabla=producto&id=<?=$id?>"><i class="fa fa-pencil"></i> Editar</a></td>
    </tr>
<?php 
    endforeach;

    ?>
  </tbody>
</table>
  </div>
