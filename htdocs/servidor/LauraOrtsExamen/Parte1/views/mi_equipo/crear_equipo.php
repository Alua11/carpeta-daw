<?php
require_once "assets/php/funciones.php";
require_once "config/db.php";

$mostrarFormulario = true;
if (isset($_SESSION['mi_equipo'])) {
  $mostrarFormulario = false;
}

if ($mostrarFormulario) {
  $cadenaErrores = "";
  $errores = [];
  $datos = [];
  $cadena = "";
  $visibilidad = "invisible";

  $conexion = db::conexion();

  $ultimoIdEquipo = false;
  $sql = "SELECT MAX(codigo_mi_equipo) FROM mi_equipo";
  $resultado = $sentencia->execute();
  if ($resultado != false) {
    $ultimoIdEquipo = $sentencia->fetch(PDO::FETCH_OBJ);
  }

  if (isset($_REQUEST["error"])) {
    $errores = $_SESSION["errores"] ?? [];
    $datos = $_SESSION["datos"] ?? [];
    $cadena =  "Atención, han ocurrido errores";
    $visibilidad = "visible";
  }

?>
  <div class="w-75" style="margin: 0 auto">

    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="inicio.php?accion=guardar&evento=crear_equipo&tabla=mi_equipo" method="POST">
      <div class="form-group">
        <input type="hidden" name="codigo_mi_equipo" value="<?= $ultimoIdEquipo ?>">
        <label for="nombre">Nombre del equipo </label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el nombre del equipo" value=<?= $_SESSION["datos"]["nombre"] ?? ""; ?>>
        <?= isset($errores['nombre']) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nombre") . "</div>" : ""; ?>
      </div>

      <button type="submit" class="btn btn-primary">Crear Equipo</button>
      <a class="btn btn-danger" href="inicio.php">Cancelar</a>
    </form>
  </div>

<?php
} else {
?>
  <div class="alert alert-danger"> Ya tienes equipo </div>
<?php
}
