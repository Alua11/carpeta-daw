<?php

function deserializar(string $cadena):array
{
    $array = [];
    $copia = $cadena;
    for ($i = 0; $i < strlen($copia); $i++) {
        $pos = strpos($copia,"||");
        $array[] = substr($copia, 0, $pos);
        $copia = substr($copia, $pos + 2);
    }
    return $array;
}

echo "<pre>";
var_dump(deserializar($_POST['array']));
echo "</pre>";