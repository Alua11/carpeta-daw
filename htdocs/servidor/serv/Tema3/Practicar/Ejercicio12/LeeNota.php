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
        $nota = $_GET["nota"];
        if(is_numeric($nota)){
            if(($nota >= 0) && ($nota <=10)){
                if($nota < 5){
                    echo "Suspendido";
                } else if(($nota >= 5) && ($nota < 6)){
                    echo "Suficiente";
                } else if(($nota >= 6) && ($nota < 7)){
                    echo "Bien";
                } else if(($nota >= 7) && ($nota < 8)){
                    echo "Notable";
                } else {
                    echo "Sobresaliente";
                }
            } else {
                echo "{$nota} no es una nota valida";
            }
        } else {
            echo "{$nota} no es un numero";
        }
    ?>
</body>
</html>