<?php
include_once("Ejercicio8.php");

function rellenar(int $numero, int $numero2)
{
    $busqueda = [];
    $numeros = 0;
    for ($i = 0; $i < $numero; $i++) {
        for ($j = 0; $j < $numero2; $j++, $numeros++) {
            $busqueda[$i][$j] = $numeros . "x";
        }
        // .$numeros}
    }
    return $busqueda;
}

$numero = $_REQUEST["numero"];
$numero2 = $_REQUEST["numero2"];
if (!is_numeric($numero) || $numero < 2 || $numero > 10) {
    $error = "Dato intrducido incorrecto, ingrese un numero entre 2 y 10";
    header("location:Ejercicio8.php?datos=" . $error);
    exit;
}

if (!is_numeric($numero2) || $numero2 < 3 || $numero2 > 10) {
    $error = "Dato intrducido incorrecto, ingrese un numero entre 3 y 10";
    header("location:Ejercicio8.php?datos=" . $error);
    exit;
}
if (isset($_REQUEST['array'])) {
    $cadeJson = $_REQUEST['array'];
    $busqueda = json_decode($cadeJson, JSON_OBJECT_AS_ARRAY);
}
if (!isset($_REQUEST["elegido_x"])) {
    $numero = $_REQUEST["numero"];
    $numero2 = $_REQUEST["numero2"];
    $busqueda = rellenar($numero, $numero2);
    $aleatorio = rand(0, $numero - 1);
    $aleatorio2 = rand(0, $numero2 - 1);
    $cont = 0;
} else {
    $numero = $_REQUEST["numero"];
    $numero2 = $_REQUEST["numero2"];
    $pulsado = $_REQUEST["eleccion"];
    $aleatorio = $_REQUEST["aleatorio"];
    $aleatorio2 = $_REQUEST["aleatorio2"];
    $cont = $_REQUEST["contador"];

    for ($i = 0; $i < count($busqueda); $i++) {
        for ($j = 0; $j < count($busqueda[$i]); $j++) {
            if ($pulsado == $busqueda[$i][$j]) {
                if ($i == $aleatorio && $j == $aleatorio2) {
                    $busqueda[$aleatorio][$aleatorio2] .= "c";
                } else {
                    $busqueda[$i][$j] .= "f";
                }
            }
        }
    }
}


$cadeJson = json_encode($busqueda, JSON_OBJECT_AS_ARRAY);


$cont++;
// for ($i = 0; $i < count($busqueda); $i++) {
//     for ($j = 0; $j < count($busqueda[$i]); $j++) {

if (strpos($busqueda[$aleatorio][$aleatorio2], "c") !== false) {

    echo "Has Ganado";
    echo "<table border=1>";

    for ($i = 0; $i < count($busqueda); $i++) {
        echo "<tr>";
        for ($j = 0; $j < count($busqueda[$i]); $j++) {
            echo "<td>";
?>
            <form action="funciones.php" method="post">
                <?php
                if ($busqueda[$i][$j] == $busqueda[$aleatorio][$aleatorio2]) {
                    $busqueda[$aleatorio][$aleatorio2] .= "c";
                } else {
                    $busqueda[$i][$j] .= "f";
                }



                if (strpos($busqueda[$i][$j], "f") !== false) {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="unnamed.png" height="150" width="150">

                <?php
                } elseif (strpos($busqueda[$i][$j], "c") !== false) {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="file_10138307_512x512.png" height="150" width="150">
                <?php
                } else {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="44622.png" height="150" width="150">

                <?php
                }
                ?>
                <input type="hidden" name="eleccion" value='<?= $busqueda[$i][$j] ?>'>
                <input type="hidden" name="array" value=<?= $cadeJson ?>>
                <input type="hidden" name="aleatorio" value=<?= $aleatorio ?>>
                <input type="hidden" name="aleatorio2" value=<?= $aleatorio2 ?>>
                <input type="hidden" name="contador" value=<?= $cont ?>>
            </form>
    <?php
            echo "</td>";
        }
        echo "</tr>";
    }
    ?>
    <br>
    <form action="Ejercicio8.php" method="post">
        <input type="submit" value="Volver a jugar">
    </form>
    <?php

} else if ($cont < 6) {
    echo "<table border=1>";
    for ($i = 0; $i < count($busqueda); $i++) {
        echo "<tr>";
        for ($j = 0; $j < count($busqueda[$i]); $j++) {
            echo "<td>";
    ?>
            <form action="funciones.php" method="post">
                <?php
                if (strpos($busqueda[$i][$j], "f") !== false) {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="unnamed.png" height="150" width="150">

                <?php
                } elseif (strpos($busqueda[$i][$j], "c") !== false) {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="file_10138307_512x512.png" height="150" width="150">
                <?php
                } else {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="44622.png" height="150" width="150">

                <?php
                }
                ?>
                <input type="hidden" name="eleccion" value='<?= $busqueda[$i][$j] ?>'>
                <input type="hidden" name="array" value=<?= $cadeJson ?>>
                <input type="hidden" name="aleatorio" value=<?= $aleatorio ?>>
                <input type="hidden" name="aleatorio2" value=<?= $aleatorio2 ?>>
                <input type="hidden" name="contador" value=<?= $cont ?>>
                <input type="hidden" name="numero" value=<?= $numero ?>>
                <input type="hidden" name="numero2" value=<?= $numero2 ?>>

            </form>
        <?php
            echo "</td>";
        }
        echo "</tr>";
    }
} else {
    echo "Has perdido";
    echo "<table border=1>";

    for ($i = 0; $i < count($busqueda); $i++) {
        echo "<tr>";
        for ($j = 0; $j < count($busqueda[$i]); $j++) {
            echo "<td>";
        ?>
            <form action="funciones.php" method="post">
                <?php
                if ($busqueda[$i][$j] == $busqueda[$aleatorio][$aleatorio2]) {
                    $busqueda[$i][$j] .= "c";
                } else {
                    $busqueda[$i][$j] .= "f";
                }



                if (strpos($busqueda[$i][$j], "f") !== false) {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="unnamed.png" height="150" width="150">

                <?php
                } elseif (strpos($busqueda[$i][$j], "c") !== false) {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="file_10138307_512x512.png" height="150" width="150">
                <?php
                } else {
                ?>
                    <input type="image" name="elegido" id="elegido" value="reserva" src="44622.png" height="150" width="150">

                <?php
                }
                ?>
                <input type="hidden" name="eleccion" value='<?= $busqueda[$i][$j] ?>'>
                <input type="hidden" name="array" value=<?= $cadeJson ?>>
                <input type="hidden" name="aleatorio" value=<?= $aleatorio ?>>
                <input type="hidden" name="aleatorio2" value=<?= $aleatorio2 ?>>
                <input type="hidden" name="contador" value=<?= $cont ?>>


        <?php
            echo "</td>";
        }
        echo "</tr>";
    }
        ?>
        <br>
        <form action="Ejercicio8.php" method="post">
            <input type="submit" value="Volver a jugar">
        </form>
    <?php
}
