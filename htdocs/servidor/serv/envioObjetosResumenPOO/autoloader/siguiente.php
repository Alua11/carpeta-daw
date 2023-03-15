<?php
include_once "funciones.php";
spl_autoload_register('mi_autoloader');

//implementamos mi_autoloader(), que recibe el nombre de la clase
//que se ha intentado inicializar
function mi_autoloader( $NombreClase ) {
    include_once $NombreClase . '.class.php';
}
$objetoA=str_to_object($_REQUEST["cadenaA"]);

var_dump($objetoA);