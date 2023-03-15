<?php
function object_to_str($objecto)
{

     //Primero Transformamos el array en una cadena de texto
     $cadenatmp = serialize($objecto);
     //Codificamos dicha cadena en formato URL para enviar correctamente
     // los caracteres especiales
     $cadena = urlencode($cadenatmp);
     //devolvemos la cadena codificada
     return $cadena;
}

function str_to_object($texto)
{
     // Esto lo hacemos por si está vacía la cadena no me cree un array
     // con una posición vacía
     $objeto = [];
     if ($texto != "") {
          // Antes de descodificar hay que quitar cualquier \ contrabarra     
          $texto = stripslashes($texto);
          // Decodifico de formato URL a texto plano
          $texto = urldecode($texto);
          // Ahora a partir de la cadena genero un array
          $objeto = unserialize($texto);
     }
     return $objeto;
}
