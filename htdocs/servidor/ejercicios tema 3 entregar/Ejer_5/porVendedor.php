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
    <p>Visualizar datos por vendedor</p>

    <table>
        <caption>Ventas totales por vendedor</caption>
        <tr>

            <?php
            for ($vendedor = 1; $vendedor <= count($ventas); $vendedor++) {
                $datosJSON = json_encode($ventas[$vendedor - 1]);
                echo "<td><a href='vendedor.php?vendedor={$vendedor}&ventasVendedor={$datosJSON}'>Vendedor {$vendedor}</a></td>";
            }
            echo "</tr><tr>";
            for ($vendedor = 0; $vendedor < count($ventas); $vendedor++) {
                $totalVendedor = 0;
                for ($producto = 0; $producto < count($ventas[$vendedor]); $producto++) {
                    $totalVendedor += $ventas[$vendedor][$producto];
                }
                echo "<td>{$totalVendedor}</td>";
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