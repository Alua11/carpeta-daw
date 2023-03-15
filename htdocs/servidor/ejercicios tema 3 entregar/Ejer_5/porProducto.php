<?php

include_once("funciones.php");

$ventas = [];
$cadenaJsonVentas = "";

if (isset($_REQUEST['ventas'])) {

    $cadenaJsonVentas = $_REQUEST['ventas'];
    $ventas = json_decode($cadenaJsonVentas, JSON_OBJECT_AS_ARRAY);
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
    <title>Ventas por Producto</title>
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
    <p>Visualizar datos por producto</p>

    <table>
        <caption>Ventas totales por producto</caption>
        <tr>

            <?php
            for ($producto = 1; $producto <= count($ventas[0]); $producto++) {
                $ventasProducto = obtenerColumna($ventas, $producto - 1);
                $datosJSON = json_encode($ventasProducto);
                echo "<td><a href='producto.php?producto={$producto}&ventasProducto={$datosJSON}'>Producto {$producto}</a></td>";
            }
            echo "</tr><tr>";

            for ($producto = 0; $producto < count($ventas[0]); $producto++) {
                $totalProducto = 0;
                for ($vendedor = 0; $vendedor < count($ventas); $vendedor++) {
                    $totalProducto += $ventas[$vendedor][$producto];
                }
                echo "<td>{$totalProducto}</td>";
            }
            ?>

        </tr>
    </table>
    <br>
    <p>Total vendido: <?= totalVendido($ventas) ?></p>
    <br>
    <?= volver($cadenaJsonVentas) ?>

</body>

</html>