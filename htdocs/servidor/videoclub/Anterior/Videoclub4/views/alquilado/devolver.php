<?php
require_once "controllers/alquiladosController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('location:index.php' );
//recoger datos
$id=$_REQUEST["id"];

$controlador= new AlquiladosController();
$controlador->devolver($id);

