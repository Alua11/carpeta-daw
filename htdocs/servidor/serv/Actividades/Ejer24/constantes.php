<?php class Coche
{
    const RUEDAS = 4;
}
// Obtener el valor mediante el nombre de la clase:
echo "Coche::Ruedas " . Coche::RUEDAS . "\n";
// Obtener el valor mediante el objeto:
$miCoche = new Coche();
echo "\$miCoche::Ruedas ". $miCoche::RUEDAS . "\n";
?>