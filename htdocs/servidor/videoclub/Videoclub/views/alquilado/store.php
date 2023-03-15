<?php
require_once "controllers/alquiladosController.php";
//recoger datos
if (!isset ($_REQUEST["id_cliente"])) header('Location:index.php?accion=crear&tabla=alquiler' );

$idCli= ($_REQUEST["id_cliente"])??"";//el id me servirá en editar
$arrayAlquiler=[
            "id_cliente"=>$idCli,
            "id_producto"=>$_REQUEST["id_producto"]
            ];
//pagina invisible
$controlador= new AlquiladosController();
if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayAlquilar);
}

/* if ($_REQUEST["evento"]=="editar"){
    //devuelve true si edita false si falla
    $controlador->editar ($idAntiguo, $arrayCliente);
} */
?>