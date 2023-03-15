<?php
error_reporting(E_ALL | E_STRICT);
class Metodosestaticos
{
    private static $atributoestatico = 'Soy un atributo estatico';
    public static $atrestaticoPublico = 'Soy estatico pero publico';
    private $atributoNoestatico = 'No soy estatico';
    public static function metodoestatico()
    {
        echo '<br />' . self::$atributoestatico . ' accedido por self::';
    }
    public static function metodoestaticoThis()
    {
        self::metodoNoestatico();
        $this->metodoNoestatico();
    }
    public static function accederAtributoNoestatico()
    {
        echo '<br />' . $this->atributoNoestatico;
    }
    public function metodoNoestatico()
    {
        echo '<br />' . self::$atributoestatico;
        echo '<br />' . $this->atributoestatico;
    }
}


// echo Metodosestaticos::$atributoestatico; //Es privado, por lo que no puede acceder.
echo Metodosestaticos::$atrestaticoPublico; //Se puede acceder a aun atributo publico.
