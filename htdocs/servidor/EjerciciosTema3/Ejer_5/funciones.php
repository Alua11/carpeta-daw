<?php

//Genera un array inicial con las ventas de cada vendedor en cada producto.
function iniciarVentas ():Array
{
    $ventas = [];
    for ( $vendedor = 0; $vendedor < 18; $vendedor++) {
        for( $producto = 0; $producto < 10; $producto++) {
            $ventas[$vendedor][$producto] = rand(0,100);
        }
    }
    return $ventas;
}

function obtenerColumna (Array $array, int $num):Array {
    $columna = [];
    for ($i = 0; $i < count($array); $i++) {
        $columna[] = $array[$i][$num];
    }
    return $columna;
}

function totalVendido (Array $array):int {
    $total = 0;

    for ($i=0; $i < count($array); $i++) { 
        for ($j=0; $j < count($array[$i]); $j++) { 
            $total += $array[$i][$j];
        }
    }

    return $total;
}

function totalVendido1 (Array $array):int {
    $total = 0;

    for ($i = 0; $i < count($array); $i++) {
        $total += $array[$i];
    }

    return $total;
}

function mostrarTodo(Array $array):string {
    $tabla = "<table><tr><td></td>";

    for ($i = 0; $i < count($array[0]); $i++) { 
        $producto = $i + 1;
        $tabla .= "<th>Producto {$producto}</th>";
    }

    $tabla .= "</tr>";

    for ($i=0; $i < count($array); $i++) { 
        $vendedor = $i + 1;
        $tabla .= "<tr><th>Vendedor {$vendedor}</th>";

        for ($j=0; $j < count($array[0]); $j++) {
            $tabla .= "<td>{$array[$i][$j]}</td>";
        }

        $tabla .= "</tr>";
    }

    $tabla .= "</table>";

    return $tabla;
}

function volver (string $cadenaJSON) {
    ?>
    <form method='GET' action='InicioVentas.php'>
        <input type='hidden' name='ventas' id='ventas' value=<?= $cadenaJSON ?>>
        <input type='submit' name='menu' id='menu' value='menu'>
    </form>
    <?php
}