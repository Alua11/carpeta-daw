<?php
require_once "controllers/videoclubController.php";
//pagina invisible
//if (!isset ($_REQUEST["id"])) header('Location:index.php' );
//recoger datos
//$id=$_REQUEST["id"];
// $controlador= new VideoclubController();
// $controlador->guardar($_SESSION['videoclub']);
unset($_SESSION['videoclub']);
header("location:index.php");

