<?php
require_once "Models/autoloader.php";
require_once "controller/digimonsController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";

$controlador = new DigimonsController();
$digimons = $controlador->listar2();

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
    $visibilidad = "visibility";
    $clase = "alert alert-success";
    //Mejorar y poner el nombre/digimon
    // $mensaje = "El digimon con id: {$_REQUEST['id']} Borrado correctamente"; Funciona
    $mensaje = "El digimon con id {$_REQUEST['id']}: {$_REQUEST['nombre']} Borrado correctamente";
    if (isset($_REQUEST["error"])) {
        $clase = "alert alert-danger ";
        $mensaje = "ERROR!!! No se ha podido borrar el digimon con id: {$_REQUEST['id']}";
    }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
    <?= $mensaje ?>
</div>
<table class="table table-light table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Ataque</th>
            <th scope="col">Defensa</th>
            <th scope="col">Tipo</th>
            <th scope="col">Nivel</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($digimons as $digimon) :
            $id = $digimon->id;
        ?>
            <tr>
                <th scope="row"><?= $id ?></th>
                <td><?= $digimon->getNombre() ?></td>
                <td><?= $digimon->getAtaque() ?></td>
                <td><?= $digimon->getDefensa() ?></td>
                <td><?= $digimon->getTipo() ?></td>
                <td><?= $digimon->getNivel() ?></td>
                <td><a class="btn btn-danger" href="index.php?accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                <td><a class="btn btn-success" href="index.php?accion=editar&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>