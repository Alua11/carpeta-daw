<?php 
class estático
{
private static $cantidadInstancias = 0;
public function __construct()
{
self::$cantidadInstancias++;
}
public static function getInstancias()
{
return self::$cantidadInstancias;
}
}
echo '<br/>Acceso estático: ' . estático::getInstancias(); // (0)
$instancia_01 = new estático();
echo '<br/>Acceso estático: ' . estático::getInstancias(); // (1)
echo '<br/>Instancia Uno: ' . $instancia_01->getInstancias(); // (2)
$instancia_02 = new estático();
echo '<br/>Acceso estático: ' . estático::getInstancias(); // (3)
echo '<br/>Instancia Uno: ' . $instancia_01->getInstancias(); // (4)
echo '<br/>Instancia Dos: ' . $instancia_02->getInstancias(); // (5)
#################################################################
# SALIDA #
#################################################################
?>
