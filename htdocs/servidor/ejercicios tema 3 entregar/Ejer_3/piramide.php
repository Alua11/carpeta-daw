<?php

//include("funciones.php");
//require_once("funciones.php");
include_once("funciones.php");

$piramide = "";
if (isset($_GET["altura"])) {
    $altura = $_GET["altura"];

    if (is_numeric($altura)) {
        $altura *= 1;
        if (is_int($altura) && $altura > 2) {
            $piramide = crearPiramide($altura);
        } else {
            $piramide =  "El valor {$altura} no es valido, debe ser un valor entero mayor que 2";
        }
    } else {
        $piramide = "{$altura} no es un numero.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Tema 3</title>
</head>

<body>
    <h2>Ejercicio 3</h2>
    <p>Se lee un numero positivo mayor que 2 y se muestra una pirámide con esa altura, rellena de numeros.</p>

    <form method="GET" action="<?= $_SERVER['PHP_SELF'] ?>">
        ¿Que altura quieres que tenga la piramide? <input type="number" name="altura" id="altura" value="<?= ($_GET['altura']) ?? 5; ?>">
        <input type="submit" value="Dibujar">
    </form>
    <?= $piramide; ?>
</body>

</html>