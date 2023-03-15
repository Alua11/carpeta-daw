<?php
$cadena = (isset($_REQUEST["error"])) ? "Error, ha fallado la inserción" : "";
$visibilidad = (isset($_REQUEST["error"])) ? "visible" : "invisible";
?>
<div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
<form action="index.php?accion=guardar&evento=crear" method="POST">
    <div class="form-group">
        <label for="nombre">Nombre </label>
        <input type="text" required class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="Introduce el nombre">
    </div>
    <div class="form-group">
        <label for="ataque">Ataque</label>
        <input type="ataque" required class="form-control" id="ataque" name="ataque" placeholder="Introduce el ataque">
    </div>
    <div class="form-group">
        <label for="defensa">Defensa </label>
        <input type="text" class="form-control" id="defensa" name="defensa" placeholder="Introduce la defensa">
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
    <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>