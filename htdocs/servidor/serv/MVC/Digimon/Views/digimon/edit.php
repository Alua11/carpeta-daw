<?php
require_once "controller/digimonsController.php";
//recoger datos
if (!isset($_REQUEST["id"])) header('location:index.php?accion=listar');
$id = $_REQUEST["id"];
$controlador = new DigimonsController();
$digimon = $controlador->ver($id);
$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($digimon == null) {
    $visibilidad = "visibility";
    $mensaje = "El digimon con id: {$id} no existe. Por favor vuelva a la pagina anterior";
    $clase = "alert alert-danger";
    $mostrarForm = false;
}
if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "guardar") {
    $visibilidad = "visibility";
    $mensaje = "Digimon con id {$id} Modificado con éxito";
    if (isset($_REQUEST["error"])) {
        $mensaje = "No se ha podido modificar el id {$id}";
        $clase = "alert alert-danger";
    }
}
?>
<div class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
<?php
if ($mostrarForm) {
?>
    <form action="index.php?accion=guardar&evento=editar" method="POST">
        <input type="hidden" id="id" name="id" value="<?= $digimon->id ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="nombre" required class="form-control" id="nombre" name="nombre" value="<?= $digimon->nombre ?>">
        </div>
        <div class="form-group">
            <label for="ataque">Ataque </label>
            <input type="text" class="form-control" id="ataque" name="ataque" value="<?= $digimon->ataque ?>">
        </div>
        <div class="form-group">
            <label for="defensa">Defensa </label>
            <input type="text" class="form-control" id="defensa" name="defensa" value="<?= $digimon->defensa ?>">
        </div>
        <div class="form-group">
            <label for="tipo">Tipo </label>
            <select class="form-select" id="tipo" name="tipo">
                <option value="vacuna">Vacuna</option>
                <option value="virus">Virus</option>
                <option value="elemental">Elemental</option>
                <option value="animal">Animal</option>
                <option value="planta">Planta</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nivel">Nivel </label>
            <select class="form-select" id="nivel" name="nivel">
                <option value="1">Nivel 1</option>
                <option value="2">Nivel 2</option>
                <option value="3">Nivel 3</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="index.php?accion=listar">Cancelar</a>
    </form>
<?php
} else {
?>
    <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
<?php
}
