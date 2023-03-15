<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

inicioPaginasUsuario();

echo "Hola " . $_SESSION['nombre'];

formularioInicioUsuario();

botonCerrarSesion();
?>
