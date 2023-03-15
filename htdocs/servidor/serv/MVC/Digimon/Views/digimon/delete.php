<?php
require_once "controller/digimonsController.php";
//pagina invisible
if (!isset($_REQUEST["id"])) header('Location:index.php');
//recoger datos
$id = $_REQUEST["id"];
$controlador = new DigimonsController();
$controlador->borrar($id);
