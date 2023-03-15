<?php
function imprimeArray(array $array) {
    $cadena = "<pre>";
    $cadena .= var_dump($array);
    $cadena .= "</pre>";
}

$array = [];
$cadena = "";
$cadenaJson = "";

if (isset($_POST["numero"], $_POST["cadenaJson"])) {

    //Recoger datos.
    $numero = $_POST["numero"];
    $cadenaJson = $_POST["cadenaJson"];
    //Deserializar datos.
    $array = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);
    if ($numero != 0) {
        //Comprobar datos validos.

        //Que hacemos?
        $array[] = $numero;
        $cadena = "Has introducido el numero {$numero}";
    } else {
        imprimeArray($array);
        $array = [];
    }
}

//Serializar datos.
$cadenaJson = json_encode($array);

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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="numero" id="numero" value = "<?=isset($_POST['numero'])?$_POST['numero']:0?>">
        <input type="hidden" name="cadenaJson" value=<?= $cadenaJson ?>>
        <input type="submit" value="Introducir Numero">
    </form>
    <?php
    if (isset($_POST['numero']) && $numero =! 0) {
        echo $cadena;
    }
    ?>
</body>

</html>