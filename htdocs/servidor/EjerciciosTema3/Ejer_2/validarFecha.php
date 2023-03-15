<?php

include_once("funciones.php");

$no = "";
$solucion = "";

if (isset($_GET["fecha"])) {
    $fecha = $_GET["fecha"];
    $valida = esFecha($fecha);
    if (!$valida) $no = "no";
    $solucion = "La fecha \"{$fecha}\" {$no} es valida.";
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
    <h2>Ejercicio 2</h2>
    <p>Se lee una fecha y te dice si es valida o no.</p>

    <form method="GET" action="<?= $_SERVER['PHP_SELF'] ?>">
        Fecha: <input type="text" name="fecha" id="fecha" value="<?= ($_GET['fecha']) ?? "10/11/1994"; ?>">
        <br>
        <input type="submit" value="Validar">
    </form>
    <?= $solucion?>
</body>

</html>