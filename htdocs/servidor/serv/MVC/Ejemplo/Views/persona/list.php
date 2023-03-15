<?php
require_once "controller/personasController.php";
$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$controlador = new PersonasController();
$personas = $controlador->listar();
if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
    $visibilidad = "visibility";
    $clase = "alert alert-success";
    //Mejorar y poner el nombre/usuario
    //$mensaje = "El usuario con id: {$_REQUEST['id']} Borrado correctamente"; Linea original
    $mensaje = "El usuario con id {$_REQUEST['id']}: {$_REQUEST['nombre']} {$_REQUEST['apellidos']} Borrado correctamente";
    if (isset($_REQUEST["error"])) {
        $clase = "alert alert-danger ";
        $mensaje = "ERROR!!! No se ha podido borrar el usuario con id: {$_REQUEST['id']}";
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
            <th scope="col">Usuario</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Genero</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personas as $persona) :
            $id = $persona["id"];
        ?>
            <tr>
                <th scope="row"><?= $persona["id"] ?></th>
                <td><?= $persona["usuario"] ?></td>
                <td><?= $persona["nombre"] ?></td>
                <td><?= $persona["apellidos"] ?></td>
                <td><?= ($persona["genero"] == "M") ? "Masculino" : "Femenino" ?></td>
                <td><a class="btn btn-danger" href="index.php?accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                <td><a class="btn btn-success" href="index.php?accion=editar&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td>
            </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>