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
    </form>
    <?php
    function marcaEleccion()
    {
        $eleccion = null;
        if (isset($_POST["piedra_x"])) {
            $eleccion = 0;
        }
        if (isset($_POST["papel_x"])) {
            $eleccion = 1;
        }
        if (isset($_POST["tijera_x"])) {
            $eleccion = 2;
        }
        return $eleccion ?? null;
    }

    function transformar($numero)
    {
        $palabra = null;
        switch ($numero) {
            case 0:
                $palabra = "PIEDRA";
                break;
            case 1:
                $palabra = "PAPEL";
                break;
            case 2:
                $palabra = "TIJERA";
                break;
        }
        return $palabra;
    }

    $eleccion = marcaEleccion();

    if (isset($eleccion)) {
        $maquina = rand(0, 2);
        $contenido = "Algo ha pasado.";
        $resultado = $eleccion . $maquina;
        if ($eleccion == $maquina) {
            $contenido = "EMPATE";
        } else {
            switch ($resultado) {
                case "02":
                case "10":
                case "21":
                    $contenido = "HAS GANADO";
                    break;
                default:
                    $contenido = "HAS PERDIDO";
                    break;
            }
        }
        $eleccionMaquina = transformar($maquina);
        $eleccionJuego = transformar($eleccion);
        echo "<h2 style='color:white;'>{$eleccionJuego} vs {$eleccionMaquina}, {$contenido}</h2>";
    }

    ?>
</body>

</html>