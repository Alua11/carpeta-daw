<?php
require_once "controllers/productosController.php";

if (!isset($_REQUEST["nomproducto"])) header('Location:index.php?accion=crear&tabla=piezas');

$idAntiguo = ($_REQUEST["idAntiguo"]) ?? ""; //el id me servirá en editar

if ($_REQUEST['tipo'] == 'juego') {
    $arrayProducto = ["nomproducto" => $_REQUEST["nomproducto"], "preciovent" => $_REQUEST["preciovent"], "genero" => $_REQUEST["genero"], "tipo" => $_REQUEST['tipo'], "plataforma" => $_REQUEST['plataforma']];
} elseif ($_REQUEST['tipo'] ==  'CD') {
    $arrayProducto = ["nomproducto" => $_REQUEST["nomproducto"], "preciovent" => $_REQUEST["preciovent"], "genero" => $_REQUEST["genero"], "tipo" => $_REQUEST['tipo'], "idioma" => $_REQUEST['idioma']];
} else {
    $arrayProducto = ["nomproducto" => $_REQUEST["nomproducto"], "preciovent" => $_REQUEST["preciovent"], "genero" => $_REQUEST["genero"], "tipo" => $_REQUEST['tipo'], "duracion" => $_REQUEST['duracion']];
}

$controlador = new ProductosController();
if ($_REQUEST["evento"] == "crear") {
    $controlador->crear($arrayProducto);
}

/*if ($_REQUEST["evento"]=="editar"){
    //devuelve true si edita false si falla
    $controlador->editar ($idAntiguo, $arrayProducto);
}*/
