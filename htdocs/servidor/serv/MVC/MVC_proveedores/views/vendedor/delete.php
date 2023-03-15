<?php
require_once "controllers/vendedoresController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('Location:index.php' );
//recoger datos
$id=$_REQUEST["id"];

$controlador= new VendedoresController();
$controlador->borrar ($id);

