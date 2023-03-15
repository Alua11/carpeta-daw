<?php
require_once "controllers/piezasController.php";

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos=false;
$controlador = new piezasController();
$campo="numpieza";$metodo="contiene";$texto="";

if (isset($_REQUEST["evento"])){
  $mostrarDatos=true;
  switch ($_REQUEST["evento"]){
    case "todos":
      $piezas = $controlador->listar();
      $mostrarDatos=true;
      break;
    case "filtrar":
      $campo=($_REQUEST["campo"])??"numpieza";
      $metodo=($_REQUEST["metodoBusqueda"])??"contiene";
      $texto=($_REQUEST["busqueda"])??"";
      //var_dump($_REQUEST);
      $piezas = $controlador->buscar($campo, $metodo, $texto);
      break;
    case "borrar":
      $visibilidad = "visibility";
      $mostrarDatos=true;
      $clase = "alert alert-success";
      //Mejorar y poner el nombre/usuario
      $mensaje = "La pieza con id: {$_REQUEST['id']} Borrado correctamente";
      if (isset($_REQUEST["error"])) {
          $clase = "alert alert-danger ";
          $mensaje = "ERROR!!! No se ha podido borrar la pieza con Numero de Pieza: {$_REQUEST['id']}";
      }
      break;
    }
}
    
  ?>
<div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
  <?= $mensaje ?>
</div>

<form action="index.php?accion=buscar&tabla=piezas&evento=filtrar" method="POST">
<div class="form-group">
    <select class="form-control" name="campo" id="campo">
      <option value="numpieza" <?= $campo=="numpieza"?"selected":""?> >Nº Pieza</option>
      <option value="nompieza" <?= $campo=="nompieza"?"selected":""?> >Nombre Pieza</option>
      <option value="preciovent"<?= $campo=="preciovent"?"selected":""?> >Precio</option>
    </select>
    <select class="form-control" name="metodoBusqueda" id="metodoBusqueda">
      <option value="empieza" <?=$metodo=="empieza"?"selected":""?> >Empieza Por</option>
      <option value="acaba" <?=$metodo=="acaba"?"selected":""?> >Acaba En </option>
      <option value="contiene" <?=$metodo=="contiene"?"selected":""?> >Contiene </option>
      <option value="igual" <?=$metodo=="igual"?"selected":""?> >Es Igual A</option>
      
    </select>
  </div>
  <input type="text" required class="form-control" id="busqueda" name="busqueda"
    value="<?=$texto?>" placeholder="texto a Buscar">
     <button type="submit" class="btn btn-success" name="Filtrar">Buscar</button>
     <a href="index.php?accion=buscar&tabla=piezas&evento=todos"  class="btn btn-info" name="Todos" role="button">Ver todos</a> 
</form>

</n=>

<?php 
if ($mostrarDatos){
  ?>
<table id="datos" class="table table-light table-hover">
<thead class="table-dark">
    <tr>
      <th scope="col">Numero de Pieza</th>
      <th scope="col">Nombre de Pieza</th>
      <th scope="col">Precio </th>
      <th>Borrar Normal</th><th>Borrar Ajax</th><th></th>

    </tr>
  </thead>
  <tbody>
<?php foreach($piezas as $pieza):
        $id=$pieza["numpieza"];
  ?>
    <tr data-fila="<?=$id?>">
      <td><?=$pieza["numpieza"]?></td>
      <td><?=$pieza["nompieza"]?></td>
      <td><?=$pieza["preciovent"]?></td>
      <td><a class="btn btn-primary" href="index.php?accion=borrar&tabla=piezas&id=<?=$id?>"> <i class="fas  fa-paint-brush"></i> Borrar</a></td>
      <td><a class="borrar btn btn-danger"  data-id="<?=$id?>" data-name="<?=$pieza["nompieza"]?>"><i class="fa fa-trash"></i> Borrar Ajax</a></td>
      <td><a class="btn btn-success" href="index.php?accion=editar&tabla=piezas&id=<?=$id?>"> <i class="fas  fa-paint-brush"></i> Editar</a></td>
    </tr>
<?php 
    endforeach;

    ?>
  </tbody>
</table>

<?php
}
?>
