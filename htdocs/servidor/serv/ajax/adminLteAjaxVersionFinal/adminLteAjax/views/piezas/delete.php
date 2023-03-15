<?php
$ruta=(file_exists("controllers/piezasController.php"))?"":"../../";
require_once $ruta."controllers/piezasController.php";
//pagina invisible
if (!isset ($_REQUEST["id"])) header('Location:index.php' );
//recoger datos
$id=$_REQUEST["id"];
$ajax= isset($_REQUEST["ajax"]);

$controlador= new piezasController();
$controlador->borrar ($id,$ajax);

