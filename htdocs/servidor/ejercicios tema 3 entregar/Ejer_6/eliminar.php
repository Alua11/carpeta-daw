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

foreach ($arrayJson as $seccion => $indice) {
    if ($seccion == $elegido) {

        foreach ($indice as $opciones => $valor) {
            foreach ($valor as $posicion => $resultado) {
                if ($dni == $resultado) {
                    $comprobar = true;
                }
            }
        }
    }
}
unset($arrayJson[$elegido][$opciones]);
$cadenaJson = json_encode($arrayJson, JSON_OBJECT_AS_ARRAY);

echo "Eliminado con exito";
require_once("menu.php");
