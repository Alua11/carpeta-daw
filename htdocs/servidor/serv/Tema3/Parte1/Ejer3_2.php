<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function cuentaLetras($cadena)
    {
        return strlen(str_replace(" ", "", $cadena));
    }
    function cuentaPalabras($cadena)
    {
        $cuenta = 1;
        $cadenaAux = trim($cadena);
        $pos = strpos($cadenaAux, " ");
        if ($pos == FALSE) {
            $cuenta = 0;
        } else {
            while ($pos != FALSE) {
                $pos = strpos($cadenaAux, " ", $pos+1);
                $cuenta++;
            }
        }
        return $cuenta;
    }
    function letrasPalabra($frase){
        
    }
    $frase = "El perro de San Roque no tiene rabo";
    echo cuentaLetras($frase);
    echo cuentaPalabras($frase);
    ?>
</body>

</html>