<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

session_start();

if (isset($_SESSION['nombre'])) {
    header("location:inicio_usuario.php");
    exit;
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
    <form method="POST" action="comprobar.php">
        Nombre: <input type="text" name="usu" id="usu" value=<?= $_GET['usu']??''?>>
        Contraseña: <input type="password" name="pass" id="pass">
        <input type="submit" name="login" id="login" value="Login">
    </form>
    <?php
    $_REQUEST['error']??'';
    botonInicio();
    ?>
</body>

</html>