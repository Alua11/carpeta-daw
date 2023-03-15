<?php

include_once("funciones.php");

$avion = [];
$asientos = crearAsientos();
$avionJSON = "";

if (!isset($_POST["avionJSON"])) {
    $avion = crearAvion();
}

if (count($_POST) == 3) {
    //Toma de datos
    $asiento = asiento();
    $avionJSON = $_POST["avionJSON"];
    $i = buscarFila($asientos, $asiento);
    $j = buscarColumna($asientos, $asiento);

    //Deserializar datos
    $avion = json_decode($avionJSON, JSON_OBJECT_AS_ARRAY);

    $avion[$i][$j] = $avion[$i][$j] ? FALSE : TRUE;
} elseif (count($_POST) == 1) {
    echo "No has seleccionado nada";
}
//Serializar datos
$avionJSON = json_encode($avion);

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
        <?= inputAvion($avion); ?>
        <input type="hidden" name="avionJSON" value=<?= $avionJSON ?>>
    </form>
</body>

</html>