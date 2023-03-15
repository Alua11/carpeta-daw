<?php
require_once "controllers/vendedoresController.php";
//recoger datos
if (!isset ($_REQUEST["numvend"])) header('location:index.php?accion=crear&tabla=vendedor' );

// $idAntiguo= ($_REQUEST["idAntiguo"])??"";//el id me servirá en editar
$arrayVendedor=[
            "numvend"       =>  $_REQUEST["numvend"],
            "nomvend"       =>  $_REQUEST["nomvend"],
            "nombrecomer"   =>  $_REQUEST["nombrecomer"],
            "telefono"      =>  $_REQUEST["telefono"],
            "calle"         =>  $_REQUEST["calle"],
            "ciudad"        =>  $_REQUEST["ciudad"],
            "provincia"     =>  $_REQUEST["provincia"],
            "cod_postal"    =>  $_REQUEST["cod_postal"]
            ];
//pagina invisible
$controlador= new VendedoresController();
if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayVendedor);
}

if ($_REQUEST["evento"]=="editar"){
    $controlador->editar ($arrayVendedor);
}
