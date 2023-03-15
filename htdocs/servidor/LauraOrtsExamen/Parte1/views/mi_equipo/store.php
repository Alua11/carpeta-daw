<?php
require_once "./models/Class/Mi_Equipo.php";

//recoger datos
if (!isset ($_REQUEST["nombre"]) || !isset($_REQUEST["codigo_jugador"])) header('location:inicio.php' );

$nombre= ($_REQUEST["nombre"])??"";
$array=[
        "codigo_mi_equipo"=>$_REQUEST['codigo_mi_equipo'],        
        "nombre"=>$_REQUEST["nombre"],
        "nick_socio"=> $_SESSION['usuario']
        ];
//pagina invisible
if ($_REQUEST["evento"]=="crear_equipo"){
    $equipo = new Mi_Equipo($array);
    $_SESSION['mi_equipo'] = $equipo;
}

if ($_REQUEST["evento"]=="seleccionar_jugadores"){

    require_once "./models/jugadorModel.php";
    $modelo = new JugadorModel();
    $jugadores = $modelo->readAll();

    $numero = $_REQUEST['codigo_jugador'];
    $_SESSION['equipo'][$numero] = $numero; //Si despues tengo que que cambiar esto, lo cambio
    $_SESSION['mi_equipo']->setCreditos_gastados($_SESSION['mi_equipo']->getCreditos_gastados() + $jugadores[$numero]->getValor());

    header('location:inicio.php?accion=seleccionar_jugadores&tabla=mi_equipo');
}
