<?php

include_once("funciones.php");

$ventas = [];
$cadenaJsonVentas = "";

if (isset($_REQUEST['ventas'])) {

    $cadenaJsonVentas = $_REQUEST['ventas'];
    $ventas = json_decode($cadenaJsonVentas, JSON_OBJECT_AS_ARRAY);
} else {

    header("location:InicioVentas.php?error=No se encuentra la pagina");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ventas</title>
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
    <p>Modificar ventas</p>

    <?= mostrarTodo($ventas) ?>

    <br>

    <form method='GET' action='modificar.php'>
        Selecciona Vendedor <select name="vendedor" id="vendedor">
            <?php
            for ($i = 0; $i < count($ventas); $i++) {
                $opcion = $i + 1;
                echo "<option>{$opcion}</option>";
            }
            ?>
        </select>

        Selecciona Producto <select name="producto" id="producto">
            <?php
            for ($i = 0; $i < count($ventas[$i]); $i++) {
                $opcion = $i + 1;
                echo "<option>{$opcion}</option>";
            }
            ?>
        </select>

        <input type="hidden" name="ventas" id="ventas" value=<?= $cadenaJsonVentas ?> />

        <input type='submit' name='seleccionar' id='seleccionar' value='Seleccionar'>
    </form>
    <br>
    <?= volver($cadenaJsonVentas) ?>
</body>

</html>