<?php
$cadenaJson = file_get_contents("https://rickandmortyapi.com/api/character");
$cadenaJson = str_replace("'", " ", $cadenaJson);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inicio.css">
    <title>Document</title>
</head>

<body>
    <input type="hidden" id="datos" name="datos" value='<?= $cadenaJson ?>'>
    <div id="capaPersonajes"></div>

    <button onclick="genera_tabla()" id="generarTabla" name="generarTabla"> Generar Tabla</button>
    <button onclick="genera_tablaPersonajes()" id="generarTablaPersonajes" name="generarTablaPersonajes"> Generar Tabla Personajes</button>
    <button onclick="borrarTabla()" id="borrarPersonajes" name="borrarPersonajes"> Borrar Personajes</button>
    <button onclick="resaltarPares()" id="resaltarPares" name="resaltarPares"> Resaltar Pares</button>
    <button onclick="resaltarImpares()" id="resaltarImpares" name="resaltarImpares"> Resaltar Impares</button>
    <button onclick="borrarClases()" id="borrarClases" name="borrarClases"> Borrar estilo</button>
    <button onclick="cambiarEspecies()" id="cambiarEspecies" name="cambiarEspecies"> Cambiar Especies</button>
    <button onclick="eliminarMasculinos()" id="eliminarMasculinos" name="eliminarMasculinos"> Eliminar Masculinos</button>


    <script src="inicio.js"></script>
</body>

</html>