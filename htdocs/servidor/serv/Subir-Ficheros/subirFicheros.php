<?php


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
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/formdata">
    <label>Imagen </label> <input type="file" name="imagen" />
    <label>PDF </label> <input type="file" name="pdf" />
    <label>Word </label> <input type="file" name="word" />
    <input type="submit" value="Enviar" />
    </form>
</body>
</html>