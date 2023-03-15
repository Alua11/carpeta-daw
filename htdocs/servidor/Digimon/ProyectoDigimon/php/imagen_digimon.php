<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

if (!isset($_POST['digimon'])) {
    header("location:ver_digimon.php");
    exit;
}

$digimon = $_POST['digimon'];
$mensaje = "";

formularioCambiarImagen();

if (isset($_FILES)) {
    foreach ($_FILES as $nombreImg => $imagen) {
        if (strlen($_FILES[$nombreImg]['name']) != 0) {
            if (formatoImagenCorrecto($nombreImg)) {
                guardarImagen($digimon, $nombreImg);
                $mensaje .= "Imagen guardada correctamente<br>";
            } else {
                $mensaje .= "El formato de la imagen no es correcto.<br>";
            }
        } else {
            $mensaje .= "No se ha seleccionado imagen.<br>";
        }
    }
}

echo $mensaje;
?>
<form method="POST" action="ver_digimon.php">
    <input type="submit" value="Ver Digimons">
</form>