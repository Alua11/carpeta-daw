<?php
require_once "controller/digimonsController.php";
$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$controlador = new DigimonsController();

$campo = "";
$tipo = "";
$textoBuscar = "";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = false;
    switch ($_REQUEST["evento"]) {
        case "todos":
            $mostrarDatos = true;
            $digimons = $controlador->listar();
            break;
        case "filtrar":
            $mostrarDatos = true;
            // $digimon = ($_REQUEST["busqueda"]) ?? "";
            $campo = ($_REQUEST["campo"]) ?? "";
            $tipo = ($_REQUEST["tipo"]) ?? "";
            $textoBuscar = ($_REQUEST["textoBuscar"]) ?? "";
            // $digimons = $controlador->buscar($digimon);
            $digimons = $controlador->buscar($campo, $tipo, $textoBuscar);
            break;
        case "borrar":
            $mostrarDatos = true;
            $visibilidad = "visibility";
            $clase = "alert alert-success";

            $mensaje = "El digimon con id {$_REQUEST['id']}: {$_REQUEST['nombre']} Borrado correctamente";
            if (isset($_REQUEST["error"])) {
                $clase = "alert alert-danger ";
                $mensaje = "ERROR!!! No se ha podido borrar el digimon con id: {$_REQUEST['id']}";
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
            <option value="id">ID</option>
            <option selected value="nombre">Nombre</option>
            <option value="tipo">Tipo</option>
            <option value="nivel">Nivel</option>
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
                $id = $digimon["id"];
            ?>
                <tr>
                    <th scope="row"><?= $digimon["id"] ?></th>
                    <td><?= $digimon["nombre"] ?></td>
                    <td><?= $digimon["ataque"] ?></td>
                    <td><?= $digimon["defensa"] ?></td>
                    <td><?= $digimon["tipo"] ?></td>
                    <td><?= $digimon["nivel"] ?></td>
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