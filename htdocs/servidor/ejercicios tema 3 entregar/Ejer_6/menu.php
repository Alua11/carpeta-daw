<?php


foreach ($arrayJson as $seccion => $indice) {
    echo "<table border=1>";
    echo $seccion;
    foreach ($indice as $opciones => $valor) {
        echo "<tr>";
        foreach ($valor as $posicion => $resultado) {
            echo "<td>";

            echo $posicion . ": " . $resultado;

            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <br>
    <form action="menuIntermedio.php" method="post">
        DNI: <input type="text" name="dni" id="dni" value=""><br>
        Trabajador: <input type="text" name="nombre" id="nombre" value=""><br>
        Apellido: <input type="text" name="apellido" id="apellido" value=""><br>
        Horas: <input type="text" name="horas" id="horas" value=""><br>
        Seccion:<select name="seccion" id="seccion">
            <?php
            foreach ($arrayJson as $seccion => $indice) {
                echo "<option>{$seccion}</option>";
            }

            ?>
        </select>
        <br>
        <input type="submit" name="calcular" id="calcular" value="Calcular">
        <input type="submit" name="modificar" id="modificar" value="Modificar">
        <input type="submit" name="agregar" id="agregar" value="agregar">
        <input type="submit" name="eliminar" id="eliminar" value="eliminar">
        <input type="submit" name="calctodo" id="calctodo" value="calcular Todo">
        <input type="hidden" id="cadenaArray" name="cadenaArray" value=<?= $cadenaJson ?>>
    </form>

</body>

</html>