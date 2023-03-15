<?php
require_once "controllers/productosController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('Location:index.php' );
//recoger datos
$id=$_REQUEST["id"];

$controlador= new ProductosController();
$controlador->borrar ($id);

