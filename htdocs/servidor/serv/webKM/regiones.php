<?php

$datos = [
    "Espanya" => [
        "Alicante" => [
            "Eleche" => 340,
            "Aspe" => 88,
            "Novelda" => 78
        ],
        "Valencia" => [
            "Burriana" => 340,
            "Xativa" => 88,
            "Gandia" => 78
        ],
        "Murcia" => [
            "Mula" => 340,
            "Caravaca" => 88,
            "Alcantarilla" => 78
        ]
    ],
    "Francia" => [
        "Burdeos" => [
            "Eleche" => 340,
            "Aspe" => 88,
            "Novelda" => 78
        ],
        "Costa Azul" => [
            "Burriana" => 340,
            "Xativa" => 88,
            "Gandia" => 78
        ],
        "Alpes" => [
            "Mula" => 340,
            "Caravaca" => 88,
            "Alcantarilla" => 78
        ]
    ],
    "UK" => [
        "Escocia" => [
            "Eleche" => 340,
            "Aspe" => 88,
            "Novelda" => 78
        ],
        "Inglaterra" => [
            "Burriana" => 340,
            "Xativa" => 88,
            "Gandia" => 78
        ],
        "Gales" => [
            "Mula" => 340,
            "Caravaca" => 88,
            "Alcantarilla" => 78
        ]
    ]

];

if (!isset($_POST["pais"])){
    header("location:paises.php");
}

$pais = $_REQUEST["pais"];

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
    <form method="post" action="localidades.php">
        Regiones: <select name="region" id="region">
            <?php 
            foreach ($datos[$pais] as $region =>$fila) {
                echo "<option>{$region}</option>";
            }
            ?>
        </select>
        <input type="hidden" name="pais" id="pais" value="<?=$pais?>">
        <input type="submit" value="Escoja Localidad">
    </form>
</body>

</html>