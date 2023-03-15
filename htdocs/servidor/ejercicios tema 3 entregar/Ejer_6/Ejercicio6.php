<?php
$secciones = [
    "Seccion1" => [
        [

            "Dni" => "36563911Y", "Nombre" => "Paco", "Apellido" => "Martinez", "Horas" => 40
        ],
    ],
    "Seccion2" => [
        [
            "Dni" => "01840878G", "Nombre" => "Lucia", "Apellido" => "Galvez", "Horas" => 35
        ],
        [
            "Dni" => "82337131Y", "Nombre" => "Laura", "Apellido" => "Garcia", "Horas" => 20
        ],

    ],
    "Seccion3" => [
        [
            "Dni" => "62244842B", "Nombre" => "Alvaro", "Apellido" => "Ballester", "Horas" => 25
        ],
        [
            "Dni" => "95307993H", "Nombre" => "Pablo", "Apellido" => "Navarro",  "Horas" => 36
        ],
        [
            "Dni" => "39660879R", "Nombre" => "Manolo", "Apellido" => "Pelegrin", "Horas" => 18
        ],


    ],
    "Seccion4" => [
        [
            "Dni" => "73201023G", "Nombre" => "Aurora", "Apellido" => "Botella", "Horas" => 22
        ],
        [
            "Dni" => "59903366G", "Nombre" => "Miriam", "Apellido" => "Sanchez", "Horas" => 5
        ],

    ],
    "Seccion5" => [
        [
            "Dni" => "26723468K", "Nombre" => "Fran", "Apellido" => "Torres", "Horas" => 37
        ],


    ],

];
$cadenaJson = json_encode($secciones, JSON_OBJECT_AS_ARRAY);
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
    <form action="inicio.php" method="post">
        Gestion de Trabajadores:
        <input type="submit" id="comenzar" name="comenzar" value="Comenzar">
        <input type="hidden" id="cadenaArray" name="cadenaArray" value=<?= $cadenaJson ?>>

    </form>

</body>

</html>
<?php
if (isset($_REQUEST["datos"])) {
    echo $_REQUEST["datos"];
}
