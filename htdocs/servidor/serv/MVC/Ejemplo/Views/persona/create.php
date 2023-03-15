<?php
$cadena = (isset($_REQUEST["error"])) ? "Error, ha fallado la inserción" : "";
$visibilidad = (isset($_REQUEST["error"])) ? "visible" : "invisible";
?>
<div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
<form action="index.php?accion=guardar&evento=crear" method="POST">
    <div class="form-group">
        <label for="usuario">Usuario </label>
        <input type="text" required class="form-control" id="usuario" name="usuario" aria-describedby="usuario" placeholder="Introduce Usuario">
        <small id="usuario" class="form-text text-muted">Compartir tu usuario lo
            hace menos seguro.</small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" required class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="nombre">Nombre </label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce tu Nombre">
    </div>
    <div class="form-group">
        <label for="apellidos">Apellidos </label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Introduce tu Apellido">
    </div>
    <div class="form-radio">
        <input type="radio" class="form-radio-input" id="genero1" name="genero" value="M">
        <label class="form-radio-label" for="genero1">Masculino</label>
        <input type="radio" class="form-radio-input" id="genero2" name="genero" value="F" checked>
        <label class="form-radio-label" for="genero2">Femenino</label>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>