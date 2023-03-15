<?php

function serializar(array $array):string
{
    $cadena = "";
    foreach ($array as $i => $value) {
        $cadena .= $array[$i] . "||";
    }
    return $cadena;
}

$array = [1, 3, 4, 533];

?>

<form action="recoge_array2.php" method="post">
    <input type="hidden" id="array" name="array" value="<?=serializar($array);?>">
    <input type="submit" value="Enviar Array">
</form>