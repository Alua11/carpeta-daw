<?php
include_once 'funcionesDigimon.php';
spl_autoload_register('mi_autoloader');

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
    <form method="POST" action="alta_usuario.php">
        <input type="submit" name="nuevoUsuario" id="nuevoUsuario" value="Nuevo Usuario">
    </form>
    <form method="POST" action="alta_digimon.php">
        <input type="submit" name="nuevoDigimon" id="nuevoDigimon" value="Nuevo Digimon">
    </form>
    <form method="POST" action="definir_evolucion.php">
        <input type="submit" name="definirDigievolucion" id="definirDigievolucion" value="Definir Evolucion">
    </form>
    <form method="POST" action="ver_digimon.php">
        <input type="submit" name="verDigimons" id="verDigimons" value="Ver Digimon">
    </form>
    <?php
    botonInicio();
    ?>
</body>

</html>