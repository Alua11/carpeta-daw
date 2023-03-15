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
        $a = 2;
        $b = 6;
        $c = 4;
        
        if ($a == 0 || ($b * $b) < (4 * $a * $c)){
            echo "No se puede resolver.";
        } else {
            $x1 = (- $b + sqrt( pow($b,2) - 4 * $a * $c)) / (2 * $a);
            $x2 = (- $b - sqrt($b * $b - 4 * $a * $c)) / (2 * $a);

            echo "La primera solucion es {$x1}<br>"; // La mejor forma de escribir esto, es separando las variables entre llaves.
            echo "La segunda solucion es {$x2}";
        }  
    ?>
</body>
</html>