<?php
$directorio = opendir(".");
//En caso de querer saber el contenido de un directorio dentro de este, hay que indicarle la ruta a is_file y a is_dir, para poder leerlo.
while ($archivo = readdir($directorio)) {
    if (is_file($archivo)) {
        echo "$archivo es un
        fichero.<br>";
    }
    if (is_dir($archivo)) {
        echo "$archivo es un directorio.<br>";
    }
}
