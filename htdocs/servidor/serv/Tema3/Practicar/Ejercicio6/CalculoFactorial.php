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
        $x = $_GET["num"];
        $res = 1;
        if(is_numeric($x)){
            $x*=1;
            if(is_int($x) && $x >= 0){
                for($i=1;$i<=$x;$i++){
                    $res*=$i;
                }
                echo "El factorial de {$x} es {$res}";
            } else {
                echo "El valor {$x} no es valido";
            }
        } else {
            echo "{$x} no es un numero.";
        }
    ?>
</body>
</html>