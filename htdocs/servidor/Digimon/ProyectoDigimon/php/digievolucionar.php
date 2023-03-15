<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

inicioPaginasUsuario();

$j = new Juego();
$j->digievolucionar();


botonInicioUsuario();
botonCerrarSesion();
