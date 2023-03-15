<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

inicioPaginasUsuario();

$j = new Juego();
$resultados = $j->combate();

if ($resultados['victoria'] + $resultados['derrota'] == 3) {
    echo $resultados['victoria'] >= 2 ? "Felicidades, has ganado el combate" : "Lástima, más suerte a la próxima";
    echo "<br>";
    $j->cambiosTrasCombate($resultados);
    echo "Has jugado " . $j->getUsus()[$_SESSION['nombre']]->getPJugadas() . " partidas";
    echo "<br>";
    echo "Has ganado " . $j->getUsus()[$_SESSION['nombre']]->getPGanadas() . " partidas";
}

botonInicioUsuario();
botonCerrarSesion();
