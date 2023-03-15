<?php
if (isset($_POST['Guardar'])) {
    $cadenaEquipo = $_POST['equipo'];
    $file = fopen("equipo.json", "w");
    fwrite($file, $cadenaEquipo);
    fclose($file);
}
$equipoJson = file_get_contents('equipo.json');
$personajesJson = file_get_contents('starwar.json');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/estilos.css" media="screen" />
</head>

<body>
    <input type="hidden" id="personajes" name="personajes" value='<?= $personajesJson ?>'>

    <div id="equipo1" class="equipoClass" onclick="seleccionarComponente(0)"></div>
    <div id="equipo2" class="equipoClass" onclick="seleccionarComponente(1)"></div>
    <div id="equipo3" class="equipoClass" onclick="seleccionarComponente(2)"></div>

    <form action=<?= $_SERVER['PHP_SELF'] ?> method="post">
        <input type="hidden" id="equipo" name="equipo" value='<?= $equipoJson ?>'>
        <input type="submit" id="Guardar" name="Guardar" value="Guardar">
    </form>

    <hr />
    <div id="CapaPersonajes" name="CapaPersonajes"></div>
    <button id="cambiarPersonaje" name="cambiarPersonaje" onclick="cambiar()">Cambiar</button>
    <script src="script.js"></script>
</body>

</html>