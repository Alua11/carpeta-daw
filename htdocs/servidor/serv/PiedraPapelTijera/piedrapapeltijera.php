<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Piedra, Papel, Tijera
<?php
    function imprimeFormulario($adivina){
        ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <input type="hidden" id="adivina" name="adivina" value='<?=$_POST["adivina"]??$adivina;?>'>    
        Decide correctamente:
            <input type="submit" id="piedra" name="eleccion" value="Piedra">
            <input type="submit" id="papel" name="eleccion" value="Papel">
            <input type="submit" id="tijera" name="eleccion" value="Tijera">
        </form>
        <?php
    }

    //Todas las veces inculida la primera.
    $maquina = rand(1,3);
    imprimeFormulario($maquina);

    //Segunda y siguientes excepto la ultima.
    if (isset($_POST($eleccion))){ 
        $eleccion = $_POST["eleccion"];
    }

    ?>
</body>
</html>