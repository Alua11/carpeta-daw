<?php
require_once "controllers/clientesController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('location:index.php' );
//recoger datos
$id=$_REQUEST["id"];

$controlador= new ClientesController();
$controlador->borrar($id);

