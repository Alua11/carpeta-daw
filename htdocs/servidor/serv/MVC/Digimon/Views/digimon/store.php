<?php
require_once "controller/digimonsController.php";
//recoger datos
if (!isset($_REQUEST["nombre"])) header('location:index.php?accion=crear');
$id = ($_REQUEST["id"]) ?? ""; //el id me servirá en editar
$arrayDigimon = [
    "id" => $id,
    "nombre" => $_REQUEST["nombre"],
    "ataque" => $_REQUEST["ataque"],
    "defensa" => $_REQUEST["defensa"],
    "tipo" => $_REQUEST["tipo"],
    "nivel" => $_REQUEST["nivel"]
];
//pagina invisible
$controlador = new DigimonsController();
if ($_REQUEST["evento"] == "crear") {
    $controlador->crear($arrayDigimon);
}
if ($_REQUEST["evento"] == "editar") {
    //devuelve true si edita false si falla
    $controlador->editar($id, $arrayDigimon);
}
?>