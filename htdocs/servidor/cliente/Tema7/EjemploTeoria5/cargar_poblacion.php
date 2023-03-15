<?php
include_once("base_datos.php");
$valor = $_REQUEST["provincia"];

if ($valor == "0") echo "Aqui Van las poblaciones";
else {
    $conexion = conectar(); // Se conecta con la base de datos.
    $sql = "SELECT nombre FROM LOCALIDAD WHERE nombre_provincia='$valor'";
    $resultado = $conexion->query($sql);
    //esto es para generar una espera, NO ES NECESARIO
    sleep(1);
    echo "<SELECT name='poblaciones'>";
    $poblaciones = $resultado->fetchAll();
    foreach ($poblaciones as $indice => $poblacion) {
        $nombre = $poblacion['nombre'];
        echo "<option value='$nombre'> $nombre</option>";
    }
    echo "</SELECT>";
    $conexion = null;
}
?>