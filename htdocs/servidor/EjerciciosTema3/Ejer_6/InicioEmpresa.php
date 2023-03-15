<?php

include_once("funciones.php");

$error = $_REQUEST['error'] ?? "";
$empresa = [
    "seccion1" => [],
    "seccion2" => [],
    "seccion3" => [],
    "seccion4" => [],
    "seccion5" => []
];
$empresaJSON = "";

if (isset($_REQUEST['ventas'])) {

    //Recoger datos
    $empresaJSON = $_REQUEST["empresaJSON"];
    $empresa = json_decode($empresaJSON, JSON_OBJECT_AS_ARRAY);
}

//Serializar datos
$empresaJSON = json_encode($empresa);



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Tema 3</title>
    <!-- <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            text-align: center;
            border: solid 1px;
        }
    </style> -->
</head>

<body>
    <h2>Ejercicio 6</h2>

    <p>
        En una empresa, hay 5 seccones y en cada una de ella hay distintos empleados.
        <br>Desde aqui, puesdes modificar los empleados cambiando desde el nombre hasta
        las horas trabajadas y ver la informacion de todos ellos.
    </p>

    <form method="GET" action="redireccion.php">
        <input type="hidden" name="empresa" id="empresa" value=<?= $empresaJSON ?> />
        <input type="submit" name="introducir" id="introducir" value="Dar de alta">
        <input type="submit" name="listar" id="listar" value="Ver trabajadores">
        <input type="submit" name="modificar" id="seleccionarModificar" value="Modificar datos">
    </form>
    <br>
    <?= $error ?>
    <br>
</body>

</html>