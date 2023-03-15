<?php
spl_autoload_register('mi_autoloader');
function mi_autoloader($NombreClase)
{
    include_once 'Clases/' . $NombreClase . '.php';
}

echo "En estos tres juegos, se muestra como se van añadiendo personajes y armas al juego";
$monkey = new Juego("The Secret of Monkey Island", "SCUMM");
echo $monkey;

$guybrush = new Personaje("Guybrush Threepwood", "unkown", "Grog");
$monkey->setPersonaje($guybrush);
echo $monkey;

$espada = new Arma("Espada", "cortante", 20);
$guybrush->setArma($espada);
echo $monkey;

echo "Creamos un juego nuevo clonado del anterior y lo mostramos, tambien vamos a clonar el personaje y el arma<br>";

$juegoClonado = clone $monkey;
$personajeClonado = clone $guybrush;
$armaClonada = clone $espada;

echo "Juego original<br>" . $monkey;
echo "Juego Clonado<br>" . $juegoClonado;

echo "Cambiamos algunos atributos de los clones y vemos que pasa:<br>";

$juegoClonado->setTitulo("Juego Clonado");
$personajeClonado->setNombre("Personaje Clonado");
$armaClonada->setNombre("Arma Clonada");

echo "Juego original<br>" . $monkey;
echo "Juego Clonado<br>" . $juegoClonado;

echo "Aparece el nuevo titulo del Juego, pero las armas clonadas no han sido asignadas y como no son las mismas que las originales, no cambian<br>";

$juegoClonado->setPersonaje($personajeClonado);
$guybrush->setArma($armaClonada);

echo "Juego original<br>" . $monkey;
echo "Juego Clonado<br>" . $juegoClonado;
