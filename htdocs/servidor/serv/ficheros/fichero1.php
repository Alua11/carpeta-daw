<?php
//abrir

//r leer
//w escribir si existe BORRA!!!!!
//r+ leer y ESCRIBIR.
//w+ => PARA BORRAR CONTENIDO
//a+ 
//r, va machacando mientras escribe. a+, escribe a continuacion del contenido actual.
$file = fopen("fichero.txt","a+");


//Escribir
$linea = ";laksdjf;ljasdl;f".PHP_EOL;
fwrite($file,$linea);
//Al terminar de escribir, mejor cerrar
fclose($file);

//Antes de leer, volver a abrir el fichero.
$file = fopen("fichero.txt","r");

//Leer ficheros con fread.
//$contenido = fread($file,filesize("fichero.txt"));
//$contenido = fread ($file,22);
//echo $contenido;


//fgetc imprimes de este modo caracter a caracter, no se suele usar.
//while (($caracter = fgetc($file)) == false) {
//    $caracter = fgetc($file);
//    echo $caracter;
//}


//fgets imprimes linea a linea el fichero.
//La i es para ver cada uno de las lineas, esto no hace falta.
$i = 1;
while (feof($file) == false) {
    $linea = trim(fgets($file)); //Es necesario un trim para que a la hora de comparar las lineas, no cuente los saltos de linea.
    $longitud = strlen($linea);
    echo "<br> {$i} {$linea} {$longitud}";
    $i++;
}


//fscanf
//echo "<pre>";
//while ($info = fscanf($file, "%s\t%s")) {
//    var_dump($info);
//    list($usu,$contra) = $info;
//}
//echo "<pre>";


//Es necesario cerrar el fichero siempre al terminar.
fclose($file);