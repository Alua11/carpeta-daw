<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Escribe tu ecuacion de segundo grado.
    <!--
        En lugar del nombre del propio archivo, se puede usar "$_SERVER['PHP_SELF']" entre etiquetas de codigo php
        Con este sistema, no seria necesario actualizar el nombre en caso de cambiar el nombre del archivo.
    -->
    <form action="ecuacion2grado.php" method="post">
        <input type="text" id="a" name="a" value='<?=$_POST["a"]??1;?>' size="1">X^2 + 
        <input type="text" id="b" name="b" value='<?=$_POST["b"]??0;?>' size="1">X + 
        <input type="text" id="c" name="c" value='<?=$_POST["c"]??0;?>' size="1"> = 0

        <input type="submit" id="boton" name="boton" value="Calcular">
    </form>
    <?php
        if(isset($_POST["a"])){
            $a = $_POST["a"];
            $b = $_POST["b"];
            $c = $_POST["c"];
            if(is_numeric($a) && is_numeric($b) && is_numeric($c)){
                if($a == 0 || ($b * $b) < (4 * $a * $c)){
                    if ($a == 0){
                        echo "El valor de X^2 no puede ser 0";
                    } else {
                        echo "En este caso obtenemos una raiz negativa, no se puede calcular.";
                    }
                } else {
                    $x1 = (- $b + sqrt( pow($b,2) - 4 * $a * $c)) / (2 * $a);
                    $x2 = (- $b - sqrt($b * $b - 4 * $a * $c)) / (2 * $a);

                    echo "La primera solucion es {$x1}<br>"; // La mejor forma de escribir esto, es separando las variables entre llaves.
                    echo "La segunda solucion es {$x2}";
                }
            } else {
                echo "Algun valor no es un numero";
            }
        }
        ?>
</body>
</html>