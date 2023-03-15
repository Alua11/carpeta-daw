<?php
require_once "controllers/productosController.php";
//recoger datos
if (!isset($_REQUEST["id"])) header('location:index.php?accion=listar&tabla=producto');
$id = $_REQUEST["id"];
$controlador = new ProductosController();
$producto = $controlador->ver($id);

$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;
if ($producto == null) {
  $visibilidad = "visbility";
  $mensaje = "La pieza con id: {$id} no existe. Por favor vuelva a la pagina anterior";
  $clase = "alert alert-danger";
  $mostrarForm = false;
}

if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "guardar") {
  $visibilidad = "vibility";
  $mensaje = "Producto modificado con éxito";
  $clase = "alert alert-success";
  if (isset($_REQUEST["error"])) {
    $mensaje = "No se ha podido modificar el numero de Pieza {$id}";
    $clase = "alert alert-danger";
  }
}
?>
<div class="w-75" style="margin: 0 auto">
<div class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
<?php
if ($mostrarForm) {
?>
  <form action="index.php?accion=guardar&evento=editar&tabla=producto" method="POST">
    <input type="hidden" id="idAntiguo" name="idAntiguo" value="<?= $producto->getID() ?>">
    <div class="form-group mt-5">
      <label for="nomproducto">Nombre </label>
      <input type="text" class="form-control mb-4" id="nomproducto" name="nomproducto" value="<?= $producto->getNombre() ?>" placeholder="Introduce el nombre">
    </div>
    <div class="form-group">
      <label for="precio">Precio de Venta </label>
      <input type="text"class="form-control mb-4" id="precio" name="precio" value="<?= $producto->getPrecio() ?>" placeholder="Introduce el precio">
    </div>

    <div class="form-group">
      <label for="genero">Genero</label>
      <input type="text"class="form-control mb-4" id="genero" name="genero" value="<?= $producto->getGenero() ?>" placeholder="Introduce el genero">
    </div>

    <div class="form-group">
      <label for="tipo">Tipo</label>
      <input type="text"class="form-control mb-4" id="tipo" name="tipo" value="<?= $producto->getTipo() ?>" readonly>
    </div>
<?php
    if ($producto->getTipo() == 'CD'){
      echo '
      <div class="form-group">
      <label for="idioma">Idioma</label>
      <input type="text"class="form-control mb-4" id="idioma" name="idioma" value="'.$producto->getIdioma().'" placeholder="Introduce el idioma">
      </div>
      ';
    }elseif($producto->getTipo() == 'pelicula'){
      echo '
      <div class="form-group">
      <label for="duracion">Duracion</label>
      <input type="text"class="form-control mb-4" id="duracion" name="duracion" value="'.$producto->getDuracion().'" placeholder="Introduce la duracion">
      </div>
      ';
    }else{
      echo '
      <select required class="form-select mb-4" aria-label="Default select example" name="plataforma">
      ';
      ?>
      <option value="nintendo" <?= ($producto->getPlataforma() == "nintendo")?"selected":null; ?>>Nintendo</option>
      <option value="xbox" <?= ($producto->getPlataforma() == "xbox")?"selected":null; ?>>Xbox</option>
      <option value="playstation" <?= ($producto->getPlataforma() == "playstation")?"selected":null; ?>>Playstation</option>
      <?php
      echo '
      </select>
      ';
    }

?>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a class="btn btn-danger" href="index.php?accion=listar&tabla=producto">Cancelar</a>
  </form>
<?php
} else {
?>
  <a href="index.php?accion=listar&tabla=producto" class="btn btn-primary">Volver a Listar</a>
</div>
<?php
}
