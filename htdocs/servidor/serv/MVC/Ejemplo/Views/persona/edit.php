<?php
require_once "controller/personasController.php";
//recoger datos
if (!isset($_REQUEST["id"])) header('location:index.php?accion=listar');
$id = $_REQUEST["id"];
$controlador = new PersonasController();
$persona = $controlador->ver($id);
$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($persona == null) {
    $visibilidad = "visibility";
    $mensaje = "La persona con id: {$id} no existe. Por favor vuelva a la pagina anterior";
    $clase = "alert alert-danger";
    $mostrarForm = false;
}
if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "guardar") {
    $visibilidad = "visibility";
    $mensaje = "Persona con id {$id} Modificado con éxito";
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
        <input type="hidden" id="id" name="id" value="<?= $persona->id ?>">
        <div class="form-group">
            <label for="usuario">Usuario </label>
            <input type="text" required class="form-control" id="usuario" name="usuario" aria-describedby="usuario" value="<?= $persona->usuario ?>">
            <small id="usuario" class="form-text text-muted">Compartir tu usuario lo hace menos seguro.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" required class="form-control" id="password" name="password" value="<?= $persona->password ?>">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $persona->nombre ?>">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos </label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $persona->apellidos ?>">
        </div>
        <div class="form-radio">
            <input type="radio" class="form-radio-input" id="genero1" name="genero" value="M" <?= ($persona->genero == 'M') ? 'checked' : '' ?>>
            <label class="form-radio-label" for="genero1">Masculino</label>
            <input type="radio" class="form-radio-input" id="genero2" name="genero" value="F" <?= ($persona->genero == 'F') ? 'checked' : '' ?>>
            <label class="form-radio-label" for="genero2">Femenino</label>
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
