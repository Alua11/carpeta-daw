<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- 
        Primer caso: Cuando el isset es false. Fromulario en el que te pide el numero a acertar y generar el numero.
        Segundo caso: Cuando isset es true y no has acertado el numero.
        Tercer caso: Cuando isset es true y SI has acertado el numero.
    -->
    <?php
    function imprimeFormulario($adivina){
        ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            Intenta adivinar el numero: <input type="NUMBER" id="intento" name="intento" value='<?=$_POST["intento"]??1;?>'>
            <input type="hidden" id="adivina" name="adivina" value='<?=$_POST["adivina"]??$adivina;?>'>
            <input type="submit" id="boton" name="boton" value="Adivinar">
        </form>
        <?php
    }

    if (!isset($_POST['intento'])){
        $adivinar = rand(1, 100);
        imprimeFormulario($adivinar);
    }
    if (isset($_POST['intento'])){
        $adivinar = $_POST['adivina'];
        $intento = $_POST['intento'];
        if (is_numeric($intento)){
            if (is_int($intento*=1) && ($intento > 0 && $intento <= 100)){
                if ($intento != $adivinar){
                    imprimeFormulario($adivinar);
                    echo "No has acertado";
                } else {
                    echo "Ganaste, el numero era {$adivinar}";
                }
            } else {
                imprimeFormulario($adivinar);
                echo "El numero debe ser un entero entre 1 y 100, {$intento} no cumple estas condiciones.";
            }
        } else {
            imprimeFormulario($adivinar);
            echo "No has introducido un numero.";
        }
    }
    
    ?>
</body>
</html>