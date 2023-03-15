<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

session_start();

if (!isset($_REQUEST['usu'], $_REQUEST['pass'])) {
    header("location:login.php?error=Envio de datos incorrecto");
    exit;
}

$nombre = $_REQUEST['usu'];
$nombre = strtolower($nombre);
$pass = $_REQUEST['pass'];

$j = new Juego();
$usus = $j->getUsus();

if (!isset($usus[$nombre]) || (isset($usus[$nombre]) && $usus[$nombre]->getPass() != $pass)) {
    header("location:login.php?error=Algun dato es incorrecto");
    exit;
}

$_SESSION['nombre'] = $nombre;
header("location:login.php");

