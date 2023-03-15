<?php

include_once("funciones.php");

$ventas = [];
$cadenaJsonVentas = "";

if (!isset($_REQUEST['ventas'])){
    header("location:InicioVentas.php?error=Las ventas se han roto");
}

if (isset($_REQUEST['vendedor'], $_REQUEST['producto'])) {

    $cadenaJsonVentas = $_REQUEST['ventas'];
    $ventas = json_decode($cadenaJsonVentas, JSON_OBJECT_AS_ARRAY);
    $vendedor1 = $_REQUEST['vendedor'];
    $producto1 = $_REQUEST['producto'];
    $vendedor = $vendedor1 - 1;
    $producto = $producto1 - 1;

} else {

    header("location:seleccionarModificar.php?ventas={$ventas}&error=No se encuentra la pagina");

}

if (isset($_REQUEST['numero'])) {

    $ventas[$vendedor][$producto] = $_REQUEST['numero'];
    $cadenaJsonVentas = json_encode($ventas);
    echo "La cantidad ha sido cambiada correctamente.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ventas</title>
</head>

<body>
    <p>Modificar ventas del vendedor <?= $vendedor1 ?> para el producto <?= $producto1 ?></p>

    <form method='GET' action='modificar.php'>

        <input type='number' name='numero' id='numero' value=<?= $ventas[$vendedor][$producto] ?>>

        <input type='hidden' name='ventas' id='ventas' value=<?= $cadenaJsonVentas ?>>
        <input type='hidden' name='vendedor' id='vendedor' value=<?= $vendedor1 ?>>
        <input type='hidden' name='producto' id='producto' value=<?= $producto1 ?>>

        <input type='submit' name='seleccionar' id='seleccionar' value='Seleccionar'>
    </form>
    <br>
    <?= volver($cadenaJsonVentas) ?>
</body>

</html>