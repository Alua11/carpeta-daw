<?php
if (!isset($_REQUEST["cadenaArray"])) {
    header("location:Ejercicio6.php");
}
$cadenaJson = $_REQUEST["cadenaArray"];
$arrayJson = [];
$arrayJson = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);

$cadenaImprimir = "";
$dni = $_REQUEST["dni"];
$nombre = $_REQUEST["nombre"];
$apellido = $_REQUEST["apellido"];
$horas = $_REQUEST["horas"];
$seccion = $_REQUEST["seccion"];


if (isset($_REQUEST["calctodo"])) {
    require_once("calcularTodo.php");
}
if (!isset($_REQUEST["calctodo"])) {
    if (empty($dni)) {

        $error = "El dni esta vacio <br>";
        header("location:Ejercicio6.php?datos=" . $error);
        exit;
    }
    if (empty($nombre)) {
        $error = "El nombre esta vacio <br>";
        header("location:Ejercicio6.php?datos=" . $error);
        exit;
    }
    if (empty($apellido)) {
        $error = "El apellido esta vacio <br>";
        header("location:Ejercicio6.php?datos=" . $error);
        exit;
    }
    if (empty($horas)) {
        $error = "Las horas estan vacias <br>";
        header("location:Ejercicio6.php?datos=" . $error);
        exit;
    }

    if ($_REQUEST["horas"] < 50) {
        if (isset($_REQUEST["calcular"])) {

            require_once("calcular.php");
        } else if (isset($_REQUEST["modificar"])) {

            require_once("modificar.php");
        } else if (isset($_REQUEST["agregar"])) {



            require_once("agregar.php");
        } else if (isset($_REQUEST["eliminar"])) {
            require_once("eliminar.php");
        }
    } else {
        echo "Las horas introducidas deben ser menores a 50 <br>";
        require_once("menu.php");
    }
}
