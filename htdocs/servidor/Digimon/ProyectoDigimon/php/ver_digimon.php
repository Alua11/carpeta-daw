<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

$j = new Juego();
$j->mostrarTodosDigimons();
volverAdmin();
