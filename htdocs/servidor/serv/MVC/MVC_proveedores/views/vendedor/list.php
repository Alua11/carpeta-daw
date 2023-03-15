<?php
require_once "controllers/vendedoresController.php";
require_once "controllers/pedidosController.php";
require_once "controllers/preciosumController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

// $inicio = microtime(true);

$controlador = new VendedoresController();
$vendedores = $controlador->listar();

$controladorPe = new PedidosController();
$controladorPresum = new PreciosumController();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
  $visibilidad = "visibility";
  $clase = "alert alert-success";
  //Mejorar y poner el nombre/usuario
  $mensaje = "La vendedor  con Numero de Vendedor: {$_REQUEST['id']} Borrado correctamente";
  if (isset($_REQUEST["error"])) {
    $clase = "alert alert-danger ";
    $mensaje = "ERROR!!! No se ha podido borrar la vendedor con Numero de Vendedor: {$_REQUEST['id']}";
  }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>


<table class="table table-light table-hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">Numero de Vendedor</th>
      <th scope="col">Nombre de Vendedor</th>
      <th scope="col">Nombre de Comercio </th>
      <th scope="col">Telefono </th>
      <th scope="col">Calle </th>
      <th scope="col">Ciudad </th>
      <th scope="col">Provincia </th>
      <!-- <th scope="col">Codigo Postal </th> -->
      <th></th>
      <th></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($vendedores as $vendedor) :
      $id = $vendedor["numvend"];
    ?>
      <tr>
        <td><?= $vendedor["numvend"] ?></td>
        <td><?= $vendedor["nomvend"] ?></td>
        <td><?= $vendedor["nombrecomer"] ?></td>
        <td><?= $vendedor["telefono"] ?></td>
        <td><?= $vendedor["calle"] ?></td>
        <td><?= $vendedor["ciudad"] ?></td>
        <td><?= $vendedor["provincia"] ?></td>
        <!-- <td><?= $vendedor["cod_postal"] ?></td> -->
        <?php
        //Quitar el boton de borrar en caso de que no se pueda borrar
        if (count($controladorPe->buscar("numvend", "igual", $id)) <= 0 && count($controladorPresum->buscar("numvend", "igual", $id)) <= 0) {
        ?>
          <td><a class="btn btn-danger" href="index.php?accion=borrar&tabla=vendedor&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
        <?php
        } else {
          echo "<td></td>";
        }
        ?>
        <td><a class="btn btn-success" href="index.php?accion=editar&tabla=vendedor&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
      <?php
      echo "</tr>";
    endforeach;

    // $final = microtime(true);

      ?>
  </tbody>
</table>

<?php
// $tiempo = $final - $inicio;
// echo "Ha tardado {$tiempo}";