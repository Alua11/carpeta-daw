<?php
$ruta=(file_exists("controllers/piezasController.php"))?"":"../../";
require_once $ruta."controllers/piezasController.php";

//recoger datos
if (!isset ($_REQUEST["numpieza"])) header('Location:index.php?accion=crear&tabla=piezas' );

$idOriginal= ($_REQUEST["idOriginal"])??"";//el id me servirá en editar
$ajax=($_REQUEST["ajax"])??false;
$arrayPieza=[
            "idOriginal"=> $idOriginal,
            "numpieza"=>$_REQUEST["numpieza"],
            "nompieza"=>$_REQUEST["nompieza"],
            "preciovent"=>$_REQUEST["preciovent"],
            ];
//pagina invisible
$controlador= new piezasController();
if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayPieza,$ajax);
}

if ($_REQUEST["evento"]=="editar"){
    //devuelve true si edita false si falla
    $controlador->editar ($idOriginal, $arrayPieza,$ajax);
}
?>