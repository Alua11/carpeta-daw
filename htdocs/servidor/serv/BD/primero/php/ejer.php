<?php
include_once 'Digimon.php';
require_once('../config/db.php');

function serializar($objecto)
{
    $cadenatmp = serialize($objecto);
    $cadena = urlencode($cadenatmp);
    return $cadena;
}

function deserializar($texto)
{
    $objeto = [];
    if ($texto != "") {
        $texto = stripslashes($texto);
        $texto = urldecode($texto);
        $objeto = unserialize($texto);
    }
    return $objeto;
}

$fDigis = file_get_contents('../archivos/digimons.txt', FILE_USE_INCLUDE_PATH);
$arrayDigimons = deserializar($fDigis);

try {
    $conexion = db::conexion();
    echo "Connected\n";
} catch (Exception $e) {
    die("Unable to connect: " . $e->getMessage());
}

try {
    $conexion->beginTransaction();

    $sql = "INSERT INTO digimon (nombre, ataque, defensa, tipo, nivel) VALUES (:nombre,:ataque,:defensa,:tipo,:nivel)";
    $sentencia = $conexion->prepare($sql);

    foreach ($arrayDigimons as $digimon) {
        $arrayDatos = [
            ":nombre" => $digimon->getNombre(),
            ":ataque" => $digimon->getAtaque(),
            ":defensa" => $digimon->getDefensa(),
            ":tipo" => $digimon->getTipo(),
            ":nivel" => $digimon->getNivel()
        ];

        $resultado = $sentencia->execute($arrayDatos);
    }

    $conexion->commit();
} catch (Exception $e) {
    $conexion->rollBack();
    echo "Failed: " . $e->getMessage();
}


