<?php
/*Rellenamos un array de 4*4 de forma aleatoria
Calcular la suma de las filas
Calcular la suma de las columnas
La suma de la diagonal principal
La suma de la diagonal inversa
La media de todos los valores*/

//Se rellena el array.
$array = [];
for ($i = 0; $i < 4; $i++) {
    for ($j = 0; $j < 4; $j++) {
        $array[$i][] = rand(0,9);
    }
}

//Mostrar el array en forma de tabla.
echo "<table border=0>";
for ($i = 0; $i < count($array); $i++) {
    //echo "Tabla del " . $i+1 ."<br>";
    echo "<tr align='right'>";
    for ($j = 0; $j < count($array[$i]); $j++) {
        //echo $i+1 . " x " . $j+1 . " = " . "{$tablas[$i][$j]}<br>";
        echo "<td>{$array[$i][$j]}</td>";
    }
    echo "</tr>";
}
echo "</table>";

//Se suman las filas y se imprime el valor de cada una.
for ($i = 0; $i < count($array); $i++) {
    $sumaFilas = 0;
    for ($j = 0; $j < count($array[$i]); $j++) {
        $sumaFilas+=$array[$i][$j];
    }
    echo "La suma de los valores de la fila {$i} es {$sumaFilas}.<br>";
}

echo "______________________________________<br>";

//Se suman las columnas y se imprime el valor de cada una.
for ($j = 0; $j < count($array); $j++) {
    $sumaColumnas = 0;
    for ($i = 0; $i < count($array[$j]); $i++) {
        $sumaColumnas+=$array[$i][$j];
    }
    echo "La suma de los valores de la columna {$j} es {$sumaColumnas}.<br>";
}

echo "______________________________________<br>";

//Se suman los valores de la diagonal principal.
$sumaDiagonalPrincipal = 0;
for ($i = 0; $i < count($array); $i++) {
    $sumaDiagonalPrincipal += $array[$i][$i];
}
echo "La suma de los valores de la diagonal principal es {$sumaDiagonalPrincipal}.<br>";

echo "______________________________________<br>";

//Se suman los valores de la diagonal inversa.
$sumaDiagonalInversa = 0;
for ($i = 0; $i < count($array); $i++) {
    $sumaDiagonalInversa += $array[$i][count($array) - $i - 1];
}
echo "La suma de los valores de la diagonal principal es {$sumaDiagonalInversa}.<br>";

echo "______________________________________<br>";

//Calcular la media de todos los valores.
$totalNumeros = 0;
$sumaTodos = 0;
for ($i = 0; $i < count($array); $i++) {
    $totalNumeros += count($array[$i]);
    for ($j = 0; $j < count($array[$i]); $j++){
        $sumaTodos += $array[$i][$j];
    }
}
$media = $sumaTodos/$totalNumeros;
echo "La media de todos los numeros del array es: ". number_format($media,2) . "<br>";

