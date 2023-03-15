<?php
require_once "controller/personasController.php";
//pagina invisible
if (!isset($_REQUEST["id"])) header('Location:index.php');
//recoger datos
$id = $_REQUEST["id"];
$controlador = new PersonasController();
$controlador->borrar($id);
