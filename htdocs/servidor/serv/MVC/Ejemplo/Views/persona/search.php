<?php
require_once "controller/personasController.php";
$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new PersonasController();
// $usuario = "";
$campo = "";
$tipo = "";
$textoBuscar = "";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = false;
    switch ($_REQUEST["evento"]) {
        case "todos":
            $mostrarDatos = true;
            $personas = $controlador->listar();
            break;
        case "filtrar":
            $mostrarDatos = true;
            // $usuario = ($_REQUEST["busqueda"]) ?? "";
            $campo = ($_REQUEST["campo"]) ?? "";
            $tipo = ($_REQUEST["tipo"]) ?? "";
            $textoBuscar = ($_REQUEST["textoBuscar"]) ?? "";
            // $personas = $controlador->buscar($usuario);
            $personas = $controlador->buscar($campo, $tipo, $textoBuscar);
            break;
        case "borrar":
            $mostrarDatos = true;
            $visibilidad = "visibility";
            $clase = "alert alert-success";
            //Mejorar y poner el nombre/usuario
            // $mensaje = "El usuario con id: {$_REQUEST['id']} Borrado correctamente";
            $mensaje = "El usuario con id {$_REQUEST['id']}: {$_REQUEST['nombre']} {$_REQUEST['apellidos']} Borrado correctamente";
            if (isset($_REQUEST["error"])) {
                $clase = "alert alert-danger ";
                $mensaje = "ERROR!!! No se ha podido borrar el usuario con id: {$_REQUEST['id']}";
            }
            break;
    }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
    <?= $mensaje ?>
</div>
<form action="index.php?accion=buscar&evento=filtrar" method="POST">
    <div class="form-group">
        <label for="campo">Elegir campo de busqueda</label>
        <select class="form-control" name="campo">
            <option selected value="Nombre">Nombre</option>
            <option value="Apellidos">Apellidos</option>
            <option value="Genero">Genero</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tipo">Elegir tipo de busqueda</label>
        <select class="form-control" name="tipo">
            <option value="inicio">Empieza por...</option>
            <option value="final">Acaba por...</option>
            <option selected value="contiene">Contiene...</option>
            <option value="igual">Es igual a...</option>
        </select>
    </div>
    <div class="form-group">
        <label for="textoBuscar">Buscar</label>
        <input type="text" required class="form-control" id="textoBuscar" name="textoBuscar" value="<?= $textoBuscar ?>" placeholder="Buscar...">
    </div>
    <button type="submit" class="btn btn-success" name="Filtrar">Buscar</button>
</form>
<!-- Este formulario es para ver todos los datos -->
<form action="index.php?accion=buscar&evento=todos" method="POST">
    <button type="submit" class="btn btn-info" name="todos">Ver todos</button>
</form>
<?php
if ($mostrarDatos) {
?>
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