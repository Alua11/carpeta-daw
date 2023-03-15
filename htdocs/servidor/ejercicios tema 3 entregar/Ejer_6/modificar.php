<?php
if (!isset($_REQUEST["cadenaArray"])) {
    header("location:Ejercicio6.php");
}
$cadenaJson = $_REQUEST["cadenaArray"];
$arrayJson = [];
$arrayJson = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);




if (!isset($_REQUEST["enviar"])) {
    $cadenaImprimir = "";
    $dni = $_REQUEST["dni"];
    $nombre = $_REQUEST["nombre"];
    $apellido = $_REQUEST["apellido"];
    $horas = $_REQUEST["horas"];
    $elegido = $_REQUEST["seccion"];
    foreach ($arrayJson as $seccion => $indice) {
        if ($seccion == $elegido) {

            foreach ($indice as $opciones => $valor) {
                foreach ($valor as $posicion => $resultado) {
                    if ($dni == $resultado) {
                        $comprobar = true;
                    }
                }
            }
        }
    }
    if ($comprobar == true) {
?>
        <form action="modificar.php" method="post">
            Trabajador: <input type="text" name="nombre" id="nombre" value=""><br>
            Apellido: <input type="text" name="apellido" id="apellido" value=""><br>
            Horas: <input type="text" name="horas" id="horas" value=""><br>


            <input type="submit" name="enviar" id="enviar" value="enviar">
            <input type="hidden" id="dni" name="dni" value="<?= $dni ?>">
            <input type="hidden" id="seccion" name="seccion" value="<?= $elegido ?>">
            <input type="hidden" id="cadenaArray" name="cadenaArray" value=<?= $cadenaJson ?>>
            </select>
        </form>
<?php

    } else {
        echo "no existe el dni <br>";
    }
} else {
    $dni = $_REQUEST["dni"];
    $nombre = $_REQUEST["nombre"];
    $apellido = $_REQUEST["apellido"];
    $horas = $_REQUEST["horas"];
    $elegido = $_REQUEST["seccion"];
    foreach ($arrayJson as $seccion => $indice) {
        if ($seccion == $elegido) {

            foreach ($indice as $opciones => $valor) {
                foreach ($valor as $posicion => $resultado) {
                    if ($dni == $resultado) {
                        $comprobar = true;
                        $positivo = $opciones;
                    }
                }
            }
        }
    }

    $arraytemporal = array("Dni" => $dni, "Nombre" => $nombre, "Apellido" => $apellido, "Horas" => $horas);
    // array_replace($arrayJson[$elegido], $arraytemporal);
    //hacer for each y cuando encuentre la posicion añadirlo
    $arrayJson[$elegido][$opciones] = $arraytemporal;
}

$cadenaJson = json_encode($arrayJson, JSON_OBJECT_AS_ARRAY);

require_once("menu.php");
