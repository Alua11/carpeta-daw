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
        $pulgadas = $_GET["pulgadas"];
        if(is_numeric($pulgadas)){
            $pies = number_format($pulgadas/15,2);
            $codos = number_format($pies/1.3,2);
            $varas = number_format($codos/1.23,2);
            $indices = number_format($pulgadas*0.85,2);
            $orejas = number_format($pulgadas*0.99 + 2,2);
            $jamones = number_format($varas - 12 + ($indices * $orejas)/$codos,2);

            if($pulgadas == 1){
                echo "{$pulgadas} pulgada son:<br>-. {$pies} pies<br>-. {$codos} codos<br>
                -. {$varas} varas<br>-. {$indices} indices<br>-. {$orejas} orejas<br>
                -. {$jamones} jamones";
            } else {
                echo "{$pulgadas} pulgadas son:<br>-. {$pies} pies<br>-. {$codos} codos<br>
                -. {$varas} varas<br>-. {$indices} indices<br>-. {$orejas} orejas<br>
                -. {$jamones} jamones";
            }
        } else {
            echo "{$pulgadas} no es un numero";
        }
    ?>
</body>
</html>