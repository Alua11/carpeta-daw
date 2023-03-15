<?php

include_once("funciones.php");

$ventas = [];
$cadenaJsonVentas = "";

if (isset($_REQUEST['producto'], $_REQUEST['ventasProducto'])) {

    $producto = $_REQUEST['producto'];
    $cadenaJsonVentas = $_REQUEST['ventasProducto'];
    $ventas = json_decode($cadenaJsonVentas, JSON_OBJECT_AS_ARRAY);

    if (count($ventas) != 18) {
        header("location:InicioVentas.php?error=Las ventas se han roto");
    }

    for ($i = 0; $i < count($ventas); $i++) {
        if (!is_numeric($ventas[$i])) {
            header("location:InicioVentas.php?error=Las ventas se han roto");
        }
    }
} else {

    header("location:InicioVentas.php?error=Las ventas se han roto");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas por Vendedor</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            text-align: center;
            border-left: solid 1px;
            border-right: solid 1px;
        }
    </style>
</head>

<body>
    <p>Visualizar ventas del producto <?= $producto ?></p>

    <table>
        <caption>Producto <?= $producto ?></caption>
        <tr>

            <?php
            for ($i = 1; $i <= count($ventas); $i++) {
                echo "<td>Vendedor {$i}</td>";
            }
            echo "</tr><tr>";
            for ($i = 0; $i < count($ventas); $i++) {
                echo "<td>{$ventas[$i]}</td>";
            }
            ?>

        </tr>
    </table>
    <br>
    <p>Total vendido: <?= totalVendido1($ventas) ?></p>

</body>

</html>