<?php

if (isset($_REQUEST["empresa"])) {
    $empresa = $_REQUEST["empresa"];
}

if (isset($_REQUEST['introducir'])) {

    header("location:introducir.php?empresa={$empresa}");

} elseif (isset($_REQUEST['listar'])){

    header("location:listar.php?empresa={$empresa}");

} else {

    header("location:InicioEmpresa.php?empresa={$empresa}&error=Peticion no encontrada");

}
