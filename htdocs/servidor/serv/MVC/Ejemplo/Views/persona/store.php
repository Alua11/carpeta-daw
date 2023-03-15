<?php
require_once "controller/personasController.php";
//recoger datos
if (!isset($_REQUEST["usuario"])) header('location:index.php?accion=crear');
$id = ($_REQUEST["id"]) ?? ""; //el id me servirá en editar
$arrayPersona = [
    "id" => $id,
    "usuario" => $_REQUEST["usuario"],
    "password" => $_REQUEST["password"],
    "nombre" => $_REQUEST["nombre"],
    "apellidos" => $_REQUEST["apellidos"],
    "genero" => $_REQUEST["genero"]
];
//pagina invisible
$controlador = new PersonasController();
if ($_REQUEST["evento"] == "crear") {
    $controlador->crear($arrayPersona);
}
if ($_REQUEST["evento"] == "editar") {
    //devuelve true si edita false si falla
    $controlador->editar($id, $arrayPersona);
}
?>