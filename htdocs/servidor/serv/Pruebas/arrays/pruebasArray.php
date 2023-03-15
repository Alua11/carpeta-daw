<?php
$array=[];
//Tabmien se pueden declarar de la siguiente manera: $array1 = array();

for($i=0;$i<10;$i++){
    //Se puede poner entre los corchetes la posicion i o vacios, ya que esto te lleva a la ultima posicion.
    $array[]=rand(0,100);
}
for($i=0;$i<10;$i++){
    echo "Posicion {$i} Valor {$array[$i]}<br>";
}

$arrayBidimensional=[];
for($i=0;$i<10;$i++){
    for($j=0;$j<10;$j++){
        $arrayBidimensional[$i][]=rand(0,100);
    }
}
var_dump($arrayBidimensional);
for($i=0;$i<10;$i++){
    echo "Fila {$i}";
    for($j=0;$j<10;$j++){
        echo "Columna {$j} Valor {$arrayBidimensional[$i][$j]}<br>";
    }
}

//Declaracion de un array con elementos.
$array2 = [
    [1,2,3],
    [4,5,6],
    [7,8,9],
    [1,5,0]
];
//Para la declaracion con la funcion array(), seria: array(array(1,2,3),(4,5,6),(7,8,9));

//Cuando es homogeneo, se puede recorrer con un for como en los casos anteriores.
//Por si algun array tiene una longitud diferente, recorremos hasta que el contador llega a count($array2);
//La funcion count(), te pasa la cantidad de elementos que tiene un array.

//Le quitamos un elemento.
unset($array2[3][1]);
//Ahora nuestro array le falta un elemento y no se puede recorrer con un for normal.

//Se necesita un froeach para que funcione.
foreach($array as $indice => $valor){
    echo "Indice: {$indice} valor: {$valor}<br>";
}

foreach($array2 as $i => $fila){
    echo "Fila: {$i}<br>";
    foreach($array2 as $j => $celda){
        //echo $array2[$i][$j];
        echo "Posicion: ({$i},{$j}) -> valor: {$celda}<br>";
    }
}