<?php
require_once "../../controllers/piezasController.php";
$controlador = new piezasController();
$campo="numpieza";$metodo="contiene";$texto="";
$respuesta["ok"]=false;
$respuesta["datos"]=[];

if (isset($_REQUEST["evento"])){
    switch ($_REQUEST["evento"]){
      case "todos":
        $respuesta["datos"] = $controlador->listar(true);
        $respuesta["ok"]=true;
        break;
      case "filtrar":
        $campo=($_REQUEST["campo"])??"numpieza";
        $metodo=($_REQUEST["metodoBusqueda"])??"contiene";
        $texto=($_REQUEST["busqueda"])??"";
        //var_dump($_REQUEST);
        $respuesta["datos"] = $controlador->buscar($campo, $metodo, $texto,true);
        $respuesta["ok"]=true;
        break;
      }
    }

echo json_encode($respuesta );



