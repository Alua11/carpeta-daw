<?php

include_once("funcionesSesiones.php");

session_start();

$avion = [];
$asientos = crearAsientos();

if (!isset($_SESSION["avion"])) {
    $avion = crearAvion();
}

if (count($_POST) == 2) {
    //Toma de datos
    $asiento = asiento();
    $avion = $_SESSION["avion"];
    $i = buscarFila($asientos, $asiento);
    $j = buscarColumna($asientos, $asiento);

    $avion[$i][$j] = $avion[$i][$j] ? FALSE : TRUE;
} elseif (count($_POST) == 1) {
    echo "No has seleccionado nada";
}
//Serializar datos
$_SESSION['avion'] = $avion;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
    <style>
        input {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <?= inputAvion($_SESSION['avion']); ?>
    </form>
</body>

</html>