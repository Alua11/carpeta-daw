<?php
include_once("base_datos.php");
$conexion = conectar(); // Se conecta con la base de datos.
//seleccionamos todos los datos que hay en datos
$sql = "SELECT distinct nombre FROM PROVINCIA";
$resultado = $conexion->query($sql);
$provincias = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($provincias as $indice => $provincia) {
    $nombre = $provincia["nombre"];
    echo "<option value=$nombre> $nombre </option>";
}
$conexion = null;
