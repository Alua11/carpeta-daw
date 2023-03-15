<?php

//include("funciones.php");
//require_once("funciones.php");
include_once("funciones.php");

$cadenaResultado="";
if (isset($_POST["numero"])){
    $numero=$_POST["numero"];

    if ($numero<1) {
        $cadenaResultado = "Por favor, introduzca numeros mayores o iguales a 1";
    } else {
        if ($numero == 1) {
            $cadenaResultado = "El numero 1, solo tiene como primo el 1";
        } else if ($numero == 2) {
            $cadenaResultado = "El numero 2, solo tiene como primos el 1 y el 2";
        } else {
            $cadenaResultado = "El numero {$numero} tiene como primos inferiores el 1 2";

            for ($i = 3; $i <= $numero; $i+=2) {
                if (esPrimo($i)) {
                    $cadenaResultado .= " {$i}";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <input type="number" name="numero" id="numero" value="<?= ($_POST['numero'])??1;?>">
        <input type="submit" value="calcular">
    </form>
    <?= imprimeConColor($cadenaResultado); ?>
</body>
</html>