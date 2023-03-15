<?php
include_once "funciones.php";
spl_autoload_register('mi_autoloader');

//implementamos mi_autoloader(), que recibe el nombre de la clase
//que se ha intentado inicializar
function mi_autoloader( $NombreClase ) {
    include_once $NombreClase . '.class.php';
}

$d=new claseD("Vale Ñ");
$c=new claseC("Vale C",$d);
$b=new claseB("Vale B",$c);
$a=new claseA("Vale A",$b);


echo "<pre>";
echo $a;
echo "</pre>";

$cadenaA=object_to_str($a);
$a2=str_to_object($cadenaA);
echo "<pre>";
echo $cadenaA;
echo var_dump($a2);
echo "</pre>";

$cadenaJsonA=json_encode($a);
$a3=json_decode($cadenaJsonA);
echo "<pre>";
echo $cadenaJsonA;
echo "<br>";
echo var_dump($a3);
echo "</pre>";
?>
<form action="siguiente.php" method="post">
<input type="hidden" name="cadenaA" value="<?=$cadenaA?>">
<input type="submit">
</form>

//echo $a;
