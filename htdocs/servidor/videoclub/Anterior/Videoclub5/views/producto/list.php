<?php
require_once "controllers/productosController.php";
require_once "controllers/alquiladosController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new ProductosController();
$controladorA = new AlquiladosController();
$productos = $controlador->listar();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  //Mejorar y poner el nombre/usuario
  $mensaje = "El producto ha sido borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "No se ha podido borrar el producto";
  }
}
?>
<div class="w-75" style="margin: 0 auto">
  <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
    <?= $mensaje ?>
  </div>

  <table class="table table-light table-hover border border-black">
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
        <th></th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($productos as $producto) :
        $id = $producto->getId();
      ?>
        <tr>
          <td><?= $producto->getId() ?></td>
          <td><?= $producto->getNombre() ?></td>
          <td><?= $producto->getPrecio() ?></td>
          <td><?= $producto->getGenero() ?></td>
          <td><?= $producto->getTipo() ?></td>
          <td><?= $producto->getPlataforma() ?></td>
          <td><?= $producto->getIdioma() ?></td>
          <td><?= $producto->getDuracion() ?></td>
          <?php
          if (count($controladorA->buscar("id_producto", $id)) <= 0) {
          ?>
            <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=producto&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
          <?php
          } else {
            echo "<td></td>";
          }
          ?>
          <td><a class="btn btn-success" href="index.php?accion=editar&tabla=producto&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>

          <?php

          $alquilable = true;
          foreach ($controladorA->buscar("id_producto", $producto->getId()) as $alquilado) {
            if ($alquilado->getFechaFin() == NULL) {
              $alquilable = false;
              echo "no";
            }
          }
          if ($alquilable) {
            echo '<td><a class="btn btn-warning" href="index.php?accion=alquileresProducto&tabla=producto&id=' . $producto->getId() . '"><i class="fa fa-pencil"></i> Alquilar</a></td>';
          } else {
            echo "<td></td>";
          }

          /* if (count($controladorA->buscar("id_producto", $producto->getId())) <= 0) {
            echo '<td><a class="btn btn-warning" href="index.php?accion=alquileresProducto&tabla=producto&id=' . $producto->getId() . '"><i class="fa fa-pencil"></i> Alquilar</a></td>';
          } else {
            foreach ($controladorA->buscar("id_producto", $producto->getId()) as $alquilado) {
              if ($alquilado->getFechaFin()) {
                echo '<td><a class="btn btn-warning" href="index.php?accion=alquileresProducto&tabla=producto&id=' . $producto->getId() . '"><i class="fa fa-pencil"></i> Alquilar</a></td>';
              }
            }
          } */

          /* if ($alquiler->getFechaFin() == NULL) {
          ?>
            <td><a class="btn btn-danger" href="index.php?accion=devolver&tabla=alquilado&id=<?= $id ?>&idcliente=<?= $cliente->getId() ?>"><i class="fa fa-trash"></i> Devolver</a></td>
          <?php
          } else {
            echo "<td></td>";
          }
          echo "</tr>"; */
          ?>
        </tr>
      <?php
      endforeach;
      ?>
    </tbody>
  </table>
</div>