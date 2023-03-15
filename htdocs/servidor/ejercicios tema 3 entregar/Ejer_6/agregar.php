<?php

$cadenaJson = $_REQUEST["cadenaArray"];
$arrayJson = [];
$arrayJson = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);

$cadenaImprimir = "";
$elegido = $_REQUEST["seccion"];
$dni = $_REQUEST["dni"];
$nombre = $_REQUEST["nombre"];
$apellido = $_REQUEST["apellido"];
$horas = $_REQUEST["horas"];
$comprobar = false;
foreach ($arrayJson as $seccion => $indice) {
    foreach ($indice as $opciones => $valor) {
        foreach ($valor as $posicion => $resultado)
            if ($dni == $resultado) {
                $comprobar = true;
                echo "Ya existe el trabajador ";
            }
    }
}
if ($comprobar == false) {
    $arraytemporal = array("Dni" => $dni, "Nombre" => $nombre, "Apellido" => $apellido, "Horas" => $horas);

    array_push($arrayJson[$elegido], $arraytemporal);
}

// echo "<pre>";
// var_dump($arrayJson);
// echo "</pre>";
$cadenaJson = json_encode($arrayJson, JSON_OBJECT_AS_ARRAY);

require_once("menu.php");
