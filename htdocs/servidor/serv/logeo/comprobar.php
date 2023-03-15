<?php

$usuarios = [
    "Rosa" => "1234",
    "Ana" => "abcd",
    "Luis" => "5678"
];

if (isset($_REQUEST['usuario'], $_REQUEST['password'])) {
    $usuario = $_REQUEST['usuario'];
    $pass = $_REQUEST['password'];

    if (isset($usuarios[$usuario]) && $pass == $usuarios[$usuario]) {
        //echo "Login Correcto";
        header("location:inicio.php?usuario={$usuario}");
    } else {
        //echo "Usuario Incorrecto";
        header("location:login.php?user={$usuario}&error=Usuario Incorrecto");
    }
} else {
    //echo "Por favor intruduce datos";
    header("location:login.php");
}
