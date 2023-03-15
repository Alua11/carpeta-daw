<?php

include_once("funciones.php");

$array = [];
$cadenaJson = "";
$mensaje = "";
if (isset($_POST["minutos"], $_POST["cadenaJson"])) {
    //Toma de datos
    $minutos = $_POST["minutos"];
    $cadenaJson = $_POST["cadenaJson"];

    //Deserializar datos
    $array = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);

    //Comprobar datos correctos.
    if (is_numeric($minutos)) {
        $minutos *= 1;
        if (is_int($minutos) && $minutos > 0 && $minutos <= 60) {
            //Se realizan los calculos.
            $array[] = $minutos;
            $mensaje = "Sesion introducida correctamente.";
        } else {
            $mensaje = "El valor {$minutos} no es valido, debe ser un valor entero entre 1 y 60";
        }
    } else {
        $mensaje = "{$minutos} no es un numero.";
    }
}
//Serializar datos
$cadenaJson = json_encode($array);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Tema 3</title>

    <style>
        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Ejercicio 4</h2>
    <p>Pregunta cuantos minutos ha durado la sisión de entrenamiento y te dice las calorias consumidas totales y el tiempo invertido total.
        <br>Va tomando datos de distintas sesiones hasta introducir un 0.
    </p>

    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        Minutos que ha durado la sesión: <input type="text" name="minutos" id="minutos" value="<?= ($_POST['minutos']) ?? 0; ?>">
        <input type="hidden" name="cadenaJson" value=<?= $cadenaJson ?>>
        <input type="submit" value="Añadir ejercicio">
    </form>
    <?php
    echo isset($_POST['minutos']) ? ($minutos != 0 ? $mensaje : mostrarSesiones($array)) : "";
    ?>
</body>

</html>