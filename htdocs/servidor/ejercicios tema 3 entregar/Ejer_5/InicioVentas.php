<?php

include_once("funciones.php");

$error = $_REQUEST['error'] ?? "";
$ventas = [];
$cadenaJsonVentas = "";

if (!isset($_REQUEST['ventas'])) {

    $ventas = iniciarVentas();
} else {

    //Recoger datos
    $cadenaJsonVentas = $_REQUEST["ventas"];
    $ventas = json_decode($cadenaJsonVentas, JSON_OBJECT_AS_ARRAY);
}
//Serializar datos
$cadenaJsonVentas = json_encode($ventas);



?>  



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Tema 3</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            text-align: center;
            border: solid 1px;
        }
    </style>
</head>

<body>
    <h2>Ejercicio 5</h2>

    <p>
        Tenemos 18 vendedores y cada uno de ellos vende 10 productos.
        <br>Aqui, vamos a poder visulaizar y modificar los datos.
    </p>

    <form method="GET" action="redireccion.php">
        <input type="hidden" name="ventas" id="ventas" value=<?= $cadenaJsonVentas ?> />
        <input type="submit" name="porProducto" id="porProducto" value="Mostrar datos por Producto">
        <input type="submit" name="porVendedor" id="porVendedor" value="Mostrar datos por Vendedor">
        <input type="submit" name="modificar" id="seleccionarModificar" value="Modificar datos">
    </form>
    <br>
    <?= $error ?>
    <br>
    <?= mostrarTodo($ventas) ?>
</body>

</html>