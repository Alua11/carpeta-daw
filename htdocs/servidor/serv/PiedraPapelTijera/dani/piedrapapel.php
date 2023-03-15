<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra, Papel y Tijeras</title>
    <style>
        .sombra:hover{
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.76);
            transition: 1s;
        }

    </style>
    
</head>

<body style="text-align:center; background-color:#161616;">
    <?php

    //generamos un número random: el 0 se toma como piedra; 1 como papel y 2 como tijera.
    function random()
    {
        $numero = rand(0, 2);

        return $numero;
    }
    //función para mostrar el formulario.
    function muestraformulario()
    {
    ?>
        <h1 style="color:white;">JUEGO PIEDRA, PAPEL O TIJERA</h1>
        <form action="piedrapapel.php">
            <input type="image" id="piedra" class="sombra" name="piedra" value="piedra" src="piedra.png" style="margin-right: 100px; width:300px; height:300px;">
            <input type="image" id="papel" class="sombra" name="papel" value="papel" src="papel.png" style="margin-right: 100px; width:300px; height:300px;">
            <input type="image" id="tijera" class="sombra" name="tijera" value="tijera" src="tijera.png" style="width:300px; height:300px;">
        </form>
    <?php
    }
    muestraformulario();
    if (isset($_GET["piedra_x"])) {
        $eleccion = "piedra";
        
    }
    if (isset($_GET["papel_x"])) {
        $eleccion = "papel";
        
    }
    if (isset($_GET["tijera_x"])) {
        $eleccion = "tijera";
        
    }

    if (isset($eleccion)) {
        $contrincante = random();
        switch ($eleccion) {
            case "piedra":
                if ($contrincante == 1) {
                    $contenido = "PIEDRA VS PAPEL, HAS PERDIDO!! :(";
                } else if ($contrincante == 2) {
                    $contenido = "PIEDRA VS TIJERAS HAS GANADO!! :D";
                } else {
                    $contenido = "PIEDRA VS PIEDRA EMPATE!! :P";
                }
                break;

            case "papel":
                if ($contrincante == 2) {
                    $contenido = "PAPEL VS TIJERA, HAS PERDIDO!! :(";
                } else if ($contrincante == 1) {
                    $contenido = "PAPEL VS PIEDRA, HAS GANADO!! :D";
                } else {
                    $contenido = "PAPEL VS PAPEL, EMPATE!! :P";
                }
                break;

            case "tijera":
                if ($contrincante == 0) {
                    $contenido = "TIJERA VS PIEDRA, HAS PERDIDO!! :(";
                } else if ($contrincante == 1) {
                    $contenido = "TIJERA VS PAPEL, HAS GANADO!! :D";
                } else {
                    $contenido = "TIJERA VS TIJERA, EMPATE!! :P";
                }
                break;
        }
        echo "<h2 style='color:white;'>{$contenido}</h2>";
    }



    ?>
</body>

</html>