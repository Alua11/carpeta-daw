<?php
require_once "controllers/clientesController.php";
//recoger datos
if (!isset ($_REQUEST["dni"])) header('Location:index.php?accion=crear&tabla=cliente' );

$dni= ($_REQUEST["dni"])??"";//el id me servirá en editar
$arrayCliente=[
            "dni"=>$_REQUEST["dni"],
            "nombre"=>$_REQUEST["nombre"],
            "apellido1"=>$_REQUEST["apellido1"],
            "apellido1" => $_REQUEST["apellido1"]
            ];
//pagina invisible
$controlador= new ClientesController();
if ($_REQUEST["evento"]=="crear"){
    $controlador->crear ($arrayCliente);
}

/* if ($_REQUEST["evento"]=="editar"){
    //devuelve true si edita false si falla
    $controlador->editar ($idAntiguo, $arrayCliente);
} */
?>