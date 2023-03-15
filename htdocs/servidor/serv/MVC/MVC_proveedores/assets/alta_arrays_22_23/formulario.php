<?php
require_once "funciones.php";

$cadenaErrores="";
$errores=[];
$datos=[];
$nombre=$nick=$dni=$password="";
$equipo="Barcelona";
$aficiones=[];
if (isset($_REQUEST["errores"])){
    $errores=json_decode ($_REQUEST["errores"],JSON_OBJECT_AS_ARRAY);
    $datos=json_decode ($_REQUEST["datos"],JSON_OBJECT_AS_ARRAY);
    $dni=$datos["dni"]; $nick=$datos["nick"]; $nombre=$datos["nombre"];
    $password=$datos["password"]; $equipo=$datos["equipo"]; 
    $aficiones=$datos["aficiones"];
    //$cadenaErrores=ImprimirErrores($errores);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="modo.css">
    <title>Document</title>
</head>
<body>
<form action="comprobar.php" method="POST">
Introduzca Nombre <input type="text" name="nombre" id="nombre" value="<?=$nombre?>">
<div class="alert alert-danger" role="alert">
  <?= DibujarErrores($errores,"nombre")?>
</div>
<br>Introduzca Nick <input type="text" name="nick" id="nick" value="<?=$nick?>"> 
<div class="error"><?= DibujarErrores($errores,"nick")?></DIV>
<br>
Introduzca Contraseña <input type="text" name="password" id='password' value="<?=$password?>" > <div class="error"><?= DibujarErrores($errores,"password")?></DIV><br>
Introduzca dni <input type="text" name="dni" id='dni' value="<?=$dni?>" > <div class="error"><?= DibujarErrores($errores,"dni")?></DIV><br>
Elije Equipo:<label> Barça<input type="radio" name="equipo" id="equipo" value="Barcelona" <?=($equipo=="Barcelona" ||empty($equipo))?"CHECKED":""?> ></label>
  <label> Madrid<input type="radio" name="equipo" id="equipo" value="Madrid" <?=$equipo=="Madrid"?"CHECKED":""?>></label>

¿ Cuales son tus aficiones?<br>
<table>
<tr>
<TD><label>Coches <input type="checkbox" name="aficiones[]"  id="coches" value="coches" <?= ExisteAficion($aficiones,"coches") ?"checked":""?> ></label></TD>
<TD><label>Deporte <input type="checkbox" name="aficiones[]" id="deporte" value="deporte" <?= ExisteAficion($aficiones,"deporte") ?"checked":""?>  ></label></TD>
</tr>
<TD><label>Fiesta <input type="checkbox" id="fiesta" name="aficiones[]" value="fiesta"  ></label></TD>
<TD><label>Sofing <input type="checkbox" id="sofing" name="aficiones[]" value="sofing"   ></label></TD>
</tr>
</table>
<input type="submit" name="alta" id="alta" value="Dar de Alta">
</form>
</body>
</html>
