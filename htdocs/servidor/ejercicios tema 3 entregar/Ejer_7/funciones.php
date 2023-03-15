<?php

function crearAvion(): array
{
    $avion = [];

    for ($i = 0; $i < 25; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $avion[$i][$j] = false;
        }
    }

    return $avion;
}
function crearAsientos(): array
{
    $avion = [];
    $num = 0;

    for ($i = 0; $i < 25; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $avion[$i][$j] = $num;
            $num++;
        }
    }

    return $avion;
}

function inputAvion(array $avion)
{
    $num = 0;
    for ($i = 0; $i < count($avion); $i++) {
        for ($j = 0; $j < count($avion[$i]); $j++) {
            if (!$avion[$i][$j]) {
?>
                <input type="image" id=<?= $num ?> name=<?= $num ?> value="vacio" src="vacio.png">
            <?php
            } else {
            ?>
                <input type="image" id=<?= $num ?> name=<?= $num ?> value="ocupado" src="ocupado.png">
<?php
            }
            $num++;
        }
        echo '<br>';
    }
}

function asiento ():string {
    $nombre = "";
    $numero = "";
    $existe = FALSE;
    for ($i = 0; $i < (25*4); $i++) {
        $nombre = $i . "_x";
        if (isset($_POST[$nombre])) {
            $existe = TRUE;
            $numero = $i;
        }
    }
    return $existe ? $numero : "";
}

function buscarFila (array $asientos, int $asiento):int {
    for ($i = 0; $i < count($asientos); $i++) {
        for ($j = 0; $j < count($asientos[$i]); $j++) {
            if ($asiento == $asientos[$i][$j]){
                return $i;
            }
        }
    }
    return -1;
}

function buscarColumna(array $asientos, int $asiento): int
{
    for ($i = 0; $i < count($asientos); $i++) {
        for ($j = 0; $j < count($asientos[$i]); $j++) {
            if ($asiento == $asientos[$i][$j]) {
                return $j;
            }
        }
    }
    return -1;
}
