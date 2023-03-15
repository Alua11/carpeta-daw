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
$sueldo = 0;
echo "La comprobacion del salario se hace mediante el dni y seccion <br>";
if (isset($_REQUEST["dni"])) {



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
    if ($comprobar == true) {

        for ($i = 1; $i <= $horas; $i++) {
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
        $cadenaImprimir = "<table border=1><tr><td> dni</td><td>nombre</td><td>apellido</td><td>horas</td><td>sueldo Bruto</td><td>impuestos</td><td>sueldo Neto</td>";
        $cadenaImprimir .= "<tr><td> {$dni}</td><td>{$nombre}</td><td>{$apellido}</td><td>{$horas}H</td><td>{$sueldo}€</td><td>{$impuestosTotales}€</td><td>{$sueldoNeto}€</td></table>";
        echo $cadenaImprimir;
        echo "<br>";
    } else {
        echo "no existe el dni <br>";
    }
}



$cadenaJson = json_encode($arrayJson, JSON_OBJECT_AS_ARRAY);

require_once("menu.php");
