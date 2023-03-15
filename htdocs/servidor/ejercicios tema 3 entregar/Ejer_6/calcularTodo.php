<?php

$cadenaJson = $_REQUEST["cadenaArray"];
$arrayJson = [];
$arrayJson = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);

$cadenaImprimir = "";



$sueldo = 0;
$horasTotales = 0;
$sueldoTotal = 0;
$impuestosTotal = 0;
$sueldoNetoTotal = 0;


foreach ($arrayJson as $seccion => $indice) {
    foreach ($indice as $opciones => $valor) {
        foreach ($valor as $posicion => $resultado) {
            if ($posicion == "Dni") {
                $dni = $resultado;
            }
            if ($posicion == "Nombre") {
                $nombre = $resultado;
            }
            if ($posicion == "Apellido") {
                $apellido = $resultado;
            }

            if ($posicion == "Horas") {
                for ($i = 1; $i <= $resultado; $i++) {
                    if ($i <= 30)
                        $sueldo = $sueldo + 6;
                    if ($i > 30 && $i <= 40)
                        $sueldo = $sueldo + 9;
                    if ($i > 40)
                        $sueldo = $sueldo + 12;
                }

                $impuestosa = 0;
                $impuestosb = 0;


                if ($sueldo > 180) {
                    $impuestosa = ($sueldo - 180) * 0.15;
                } else {
                    $impuestosb = ($sueldo) * 0.1;
                }
                $impuestosTotales = $impuestosa + $impuestosb;
                $sueldoNeto = $sueldo - $impuestosTotales;
                $cadenaImprimir = "<table border=1><tr>{$seccion}<td> dni</td><td>nombre</td><td>apellido</td><td>horas</td><td>Sueldo Bruto</td><td>impuestos</td><td>Sueldo Neto</td>";
                $cadenaImprimir .= "<tr><td> {$dni}</td><td>{$nombre}</td><td>{$apellido}</td><td>{$resultado}h</td><td>{$sueldo}€</td><td>{$impuestosTotales}€</td><td>{$sueldoNeto}€</td></table>";
                echo $cadenaImprimir;
                $sueldoTotal += $sueldo;
                $horasTotales += $resultado;
                $impuestosTotal += $impuestosTotales;
                $sueldoNetoTotal += $sueldoNeto;


                $sueldo = 0;
            }
        }
    }
}
$cadena = "<table border=1><tr><td>Horas totales</td><td>Sueldo Total Bruto</td><td>Impuestos Totales</td><td>Sueldo neto Total</td>";
$cadena .= "<tr><td>{$horasTotales}H</td><td>{$sueldoTotal}€</td><td>{$impuestosTotal}€</td><td>{$sueldoNetoTotal}€</td></tr></table>";
echo $cadena;

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


$cadenaJson = json_encode($arrayJson, JSON_OBJECT_AS_ARRAY);
require_once("menu.php");
