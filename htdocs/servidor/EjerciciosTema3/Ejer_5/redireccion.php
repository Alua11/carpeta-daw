<?php

if (isset($_REQUEST["ventas"])) {
    $ventas = $_REQUEST["ventas"];
}

if (isset($_REQUEST['porProducto'])) {

    header("location:porProducto.php?ventas={$ventas}");

} elseif (isset($_REQUEST['porVendedor'])){

    header("location:porVendedor.php?ventas={$ventas}");

} elseif (isset($_REQUEST['modificar'])){

    header("location:selecionarModificar.php?ventas={$ventas}");

} else {

    header("location:InicioVentas.php?ventas={$ventas}&error=Peticion no encontrada");

}

?>
