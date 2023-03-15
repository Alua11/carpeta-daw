<?php
$array = [];

foreach ($_POST as $indice => $valor) {
    $i = substr($indice,5);
    if (strpos($indice, 'dato_') === 0) {
        $array[$i] = $valor;
    }
}

echo "<pre>";
var_dump($array);
echo "</pre>";