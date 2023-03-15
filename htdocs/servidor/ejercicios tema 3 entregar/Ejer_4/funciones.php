<?php

function calcularKCal(int $minutos):int
{
    $consumoMinuto = [
        2,3,3,3,3,3,3,3,3,3,4,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,5,5,5,5,
        6,6,6,6,6,6,6,6,6,6,7,7,7,7,7,7,7,7,7,7,8,8,8,8,8,8,8,8,8,8
    ];

    $kcal = 0;

    for ($i = 1; $i <= $minutos; $i++) {
        $kcal += $consumoMinuto[$i - 1];
    }

    return $kcal;
}

function totalSesiones (array $min):array
{
    $totales = ["minutos" => 0, "kcal" => 0];
    for ($i = 0; $i < count($min); $i++) {
        $totales["minutos"] += $min[$i];
        $totales["kcal"] += calcularKCal($min[$i]);
    }
    return $totales;
}


function mostrarSesiones(array $sesiones):string {
    $resultado = "<table><tr><th>Numero Sesion</th><th>Duracion</th><th>Kcal<th><tr>";
    $arrayTotal = totalSesiones($sesiones);
    $i = 0;
    for ($i; $i < count($sesiones); $i++) {
        $resultado .= "<tr><th>" . $i+1 . "</th><td>" . $sesiones[$i] . "</td><td>" . calcularKCal($sesiones[$i]) . "</td></tr>";
    }
    $resultado .= "<tr><th>Totales " . $i . "</th><td>Totales " . $arrayTotal['minutos'] . "</td><td>Totales " . $arrayTotal['kcal'] . "</td></tr>";
    return $resultado;
}
