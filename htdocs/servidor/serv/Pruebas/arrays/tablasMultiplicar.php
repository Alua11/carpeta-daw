<?php
//Se rellena el array con el resultado de las tablas de multiplicar.
$tablas = [];
for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 10; $j++) {
        $tablas[$i][] = ($i + 1) * ($j + 1);
    }
}

//Se muestra por pantalla las tablas de multiplicar en forma de cuadro.
//Para darle el formato correctamente, se mete todo en una tabla.
echo "<table border=0>";
for ($i = 0; $i < count($tablas); $i++) {
    //echo "Tabla del " . $i+1 ."<br>";
    echo "<tr align='right'>";
    for ($j = 0; $j < count($tablas[$i]); $j++) {
        //echo $i+1 . " x " . $j+1 . " = " . "{$tablas[$i][$j]}<br>";
        echo "<td>{$tablas[$i][$j]}</td>";
    }
    echo "</tr>";
}
echo "</table>";
