<?php
include_once("base_datos.php");
$valor = ($_REQUEST["provincia"]) ?? "";
if ($valor == "0") echo json_encode([]);
else {
    $conexion = conectar();
    $sql = "SELECT * FROM LOCALIDAD WHERE nombre_provincia='$valor'";
    $resultado = $conexion->query($sql);
    $poblaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $conexion = null;
    echo json_encode($poblaciones);
}
