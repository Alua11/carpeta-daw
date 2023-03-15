<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="CreaColumnas.php" method="post">
        Numero: <input type="text" id="numero" name="numero" value='<?=$_POST["numero"]??1;?>'>
        <input type="submit" id="boton" name="boton">
    </form>
    <table>
        <?php
        if(isset($_POST["numero"])){
            $numero = $_POST["numero"];
            if(is_numeric($numero)){
                $numero*=1;
                if(is_int($numero) && $numero > 0){
                    $suma = $numero + 1;
                    for($i=1; $i <= $numero; $i++){
                        $col1 = $suma - $i;
                        echo "<tr><td style='width:30px;'>{$col1}</td><td style='width:30px;'>{$i}</td></tr>";
                    }
                } else {
                    echo "{$numero} no es un numero valido";
                }
            } else {
                echo "{$numero} no es un numero";
            }
        }
        ?>
    </table>
</body>
</html>