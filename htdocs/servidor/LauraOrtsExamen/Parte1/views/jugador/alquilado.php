<?php
require_once "controllers/clientesController.php";
require_once "controllers/alquiladosController.php";
require_once "controllers/productosController.php";

if (!isset($_REQUEST['id'])) {
    header("location:index.php");
}

$idCliente = $_REQUEST['id'];
$controladorCli = new ClientesController();
$cliente = $controladorCli->ver($idCliente);

$controladorAl = new AlquiladosController();
$alquileres = $controladorAl->buscar('id_cliente', $idCliente);

$controladorPro = new ProductosController();

?>
<div class="w-75" style="margin: 0 auto">

<div>
    <p>Registro Alquileres Cliente <?= $idCliente ?> <?= $cliente->getNombre() ?></p>
</div>

<table class="table table-light table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID Alquiler </th>
            <th scope="col">ID Cliente </th>
            <th scope="col">Nombre Cliente </th>
            <th scope="col">ID Producto </th>
            <th scope="col">Nombre Producto </th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($alquileres as $alquiler) :
            $id = $alquiler->getID();
        ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $alquiler->getIdCliente() ?></td>
                <td><?= $cliente->getNombre() ?></td>
                <td><?= $alquiler->getIdProducto() ?></td>
                <td><?= $controladorPro->ver($alquiler->getIdProducto())->getNombre(); ?></td>
                <?php
                if ($alquiler->getFechaFin() == NULL) {
                ?>
                    <td><a class="btn btn-danger" href="index.php?accion=devolver&tabla=alquilado&id=<?= $id ?>&idcliente=<?= $cliente->getId()?>"><i class="fa fa-trash"></i> Devolver</a></td>
            <?php
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            endforeach;

            ?>
    </tbody>
</table>
        </div>