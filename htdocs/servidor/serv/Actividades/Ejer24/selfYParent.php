<?php
class MiClase {
const CONSTANTE = 'Hola! ';
}
class Clase2 extends MiClase
{
public static $variable = 'static';
public static function miFuncion() {
echo parent::CONSTANTE;
echo self::$variable;
}
}
Clase2::miFuncion();
/* La salida por pantalla será:
Hola! static*/
?>
