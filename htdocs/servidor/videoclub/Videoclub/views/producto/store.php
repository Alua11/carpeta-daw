<?php
require_once "controllers/productosController.php";
$controlador = new ProductosController();

if (!isset($_REQUEST["nomproducto"])) header('Location:index.php?accion=crear&tabla=producto');


$id = $controlador->lastId()+1;

$idAntiguo = ($_REQUEST["idAntiguo"]) ?? ""; //el id me servirá en editar

if ($_REQUEST['tipo'] == 'juego') {
    $arrayProducto = ["id" => $id, "nombre" => $_REQUEST["nomproducto"], "precio" => $_REQUEST["precio"], "genero" => $_REQUEST["genero"], "tipo" => $_REQUEST['tipo'], "plataforma" => $_REQUEST['plataforma']];
} elseif ($_REQUEST['tipo'] ==  'cd') {
    $arrayProducto = ["id" => $id, "nombre" => $_REQUEST["nomproducto"], "precio" => $_REQUEST["precio"], "genero" => $_REQUEST["genero"], "tipo" => $_REQUEST['tipo'], "idioma" => $_REQUEST['idioma']];
} elseif ($_REQUEST['tipo'] == 'pelicula'){
    $arrayProducto = ["id" => $id, "nombre" => $_REQUEST["nomproducto"], "precio" => $_REQUEST["precio"], "genero" => $_REQUEST["genero"], "tipo" => $_REQUEST['tipo'], "duracion" => $_REQUEST['duracion']];
}else{
    $arrayProducto = ["precio" => $_REQUEST["precio"]];
}

if ($_REQUEST["evento"] == "crear") {
    $controlador->crear($arrayProducto);
}

if ($_REQUEST["evento"]=="editar"){
    $controlador->editar($idAntiguo, $arrayProducto);
}
