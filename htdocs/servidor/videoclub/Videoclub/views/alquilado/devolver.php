<?php
require_once "controllers/alquiladosController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('location:index.php' );
//recoger datos
$id=$_REQUEST["id"];
$idCliente= $_REQUEST['idcliente'];

$controlador= new AlquiladosController();
$controlador->devolver($id,$idCliente);

