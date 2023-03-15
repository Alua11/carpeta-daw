<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra, Papel y Tijeras</title>
    <style>
        .sombra:hover {
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.76);
            transition: 1s;
        }
    </style>

</head>

<body style="text-align:center; background-color:#161616;">

    <h1 style="color:white;">JUEGO PIEDRA, PAPEL O TIJERA</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="image" id="piedra" class="sombra" name="piedra" value="piedra" src="piedra.png" style="margin-right: 100px; width:300px; height:300px;">
        <input type="image" id="papel" class="sombra" name="papel" value="papel" src="papel.png" style="margin-right: 100px; width:300px; height:300px;">
        <input type="image" id="tijera" class="sombra" name="tijera" value="tijera" src="tijera.png" style="width:300px; height:300px;">
        <input type="image" id="lagarto" class="sombra" name="lagarto" value="lagarto" src="tijera.png" style="width:300px; height:300px;">
        <input type="image" id="spock" class="sombra" name="spock" value="spock" src="tijera.png" style="width:300px; height:300px;">
    </form>
    <?php
    function marcaEleccion()
    {
        $eleccion = null;
        if (isset($_POST["piedra_x"])) {
            $eleccion = "piedra";
        }
        if (isset($_POST["papel_x"])) {
            $eleccion = "papel";
        }
        if (isset($_POST["tijera_x"])) {
            $eleccion = "tijeras";
        }
        if (isset($_POST["lagarto_x"])) {
            $eleccion = "lagarto";
        }
        if (isset($_POST["spock_x"])) {
            $eleccion = "spock";
        }
        return $eleccion ?? null;
    }

    $eleccion = marcaEleccion();

    $ganadores = [
        "piedra" => ["tijeras", "lagarto"],
        "papel" => ["piedra", "spock"],
        "tijeras" => ["papel", "lagarto"],
        "lagarto" => ["papel", "spock"],
        "spock" => ["piedra", "tijeras"]
    ];
    $transformarNum = ["piedra", "papel", "tijera", "lagarto", "spock"];

    if (isset($eleccion)) {
        $maquina = $transformarNum[rand(0,4)];
        $contenido = "Algo ha pasado.";
        if ($eleccion == $maquina) {
            $contenido =  "EMPATE!!";
        } else
            foreach ($ganadores[$eleccion] as $indice => $valor) {
                if ($maquina == $valor) {
                    $contenido = "HAS GANADO";
                } else {
                    $contenido = "HAS PERDIDO";
                }
            }
        echo "<h2 style='color:white;'>{$eleccion} vs {$maquina}, {$contenido}</h2>";
    }

    ?>
</body>

</html>