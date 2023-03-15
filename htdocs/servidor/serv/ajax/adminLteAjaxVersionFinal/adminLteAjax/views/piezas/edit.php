<?php
require_once "assets/php/funciones.php";
require_once "controllers/piezasController.php";
require_once "controllers/inventariosController.php";
//recoger datos
if (!isset ($_REQUEST["id"])) header('location:index.php?accion=listar&tabla=piezas');
$id=$_REQUEST["id"];
$controlador= new piezasController();
$pieza= $controlador->ver ($id);
$controladorInv= new inventariosController();

$visibilidad="hidden";
$mensaje="";
$clase= "alert alert-success";
$mostrarForm=true;
if($pieza==null) {
  $visibilidad="visbility";
  $mensaje="La pieza con id: {$id} no existe. Por favor vuelva a la pagina anterior";
  $clase= "alert alert-danger";
  $mostrarForm=false;
 } 


?>
<div class="<?=$clase?>" <?=$visibilidad?>> <?=$mensaje?> </div>
<?php 
unset ($_SESSION["datos"]) ;
unset ($_SESSION["errores"]) ;
if ($mostrarForm) {
?>
<form id="f_actualizar" name="f_actualizar">
<input type="hidden" id="idOriginal" name="idOriginal" value="<?=$id?>">
  <div class="form-group">
    <label for="pieza">pieza </label>
    <?php
    $habilitado=(count($controladorInv->buscar("numpieza","igual",$pieza->numpieza))>0)?"readonly":"";
    ?>
    <input type="text" <?=$habilitado?>  required class="form-control" id="numpieza" name="numpieza" value="<?=$pieza->numpieza?>" aria-describedby="numpieza" placeholder="Introduce pieza">
    <small id="pieza" class="form-text text-muted">Compartir tu pieza lo hace menos seguro.</small>
    <div id="e_numpieza"  class="alert alert-danger invisible errores" role="alert"></div>

    
  </div>
  <div class="form-group">
  <label for="nompieza">Nombre </label>
    <input type="text" class="form-control" id="nompieza" name="nompieza" value="<?=$pieza->nompieza?>" placeholder="Introduce el Nombre de la pieza">
    <div id="e_nompieza"  class="alert alert-danger invisible errores" role="alert"></div>
  </div>
  <div class="form-group">
  <label for="preciovent">Precio de Venta </label>
    <input type="text" class="form-control" id="preciovent" name="preciovent" value="<?=$pieza->preciovent?>" placeholder="Introduce el Precio">
    <div id="e_preciovent"  class="alert alert-danger invisible errores" role="alert"></div>
  </div>
  
    <button type="button" id="b_guardar" name="b_guardar" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger "  href="index.php?accion=listar&tabla=piezas">Cancelar</a>
  
</form>
<?php
} 
else{
  ?>
      <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
  <?php
}
