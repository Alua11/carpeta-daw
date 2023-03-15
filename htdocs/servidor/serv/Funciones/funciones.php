<?php
//declare(strict_types=1);  //Para que sea tipado fuerte estricto, en lugar de descriptivo.


//function esPrimo ($num) {
function esPrimo (int $num):bool {  //Poniendo int y :bool, hace que tenga un tipado fuerte descriptivo.
    $num = abs($num);
    if ($num == 1 || $num == 0 || $num == 2) return true;
    if ($num % 2 == 0) return false;
    for ($i = 3; $i < (($num/2) + 1); $i+=2) {
        if ($num % $i == 0) return false;
    }
    return true;
}

function imprimeConColor ($texto, $color="blue") {
    echo "<p style = 'color: {$color}'>{$texto}</p>";
}