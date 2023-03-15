<?php
require_once "assets/php/funciones.php";
require_once "./models/jugadorModel.php";


$modelo = new JugadorModel();

$mostrarFormulario = true;
if (!isset($_SESSION['mi_equipo'])) {
  $mostrarFormulario = false;
} else if ($_SESSION['mi_equipo']->getFichajes_hechos() == "SI") {
  $mostrarFormulario = false;
}


if ($mostrarFormulario) {
  if ($_SESSION['mi_equipo']->getCreditos_gastados() < 380) {
    $jugadores = $modelo->readAll();
    $cadenaErrores = "";
    $errores = [];
    $datos = [];
    $cadena = "";
    $visibilidad = "invisible";
    $_SESSION['equipo'] ?? $_SESSION['equipo'] = [];

    if (isset($_REQUEST["error"])) {
      $errores = $_SESSION["errores"] ?? [];
      $datos = $_SESSION["datos"] ?? [];
      $cadena =  "Atención, han ocurrido errores";
      $visibilidad = "visible";
    }

?>
    <div class="w-75" style="margin: 0 auto">
      <div class="alert alert-danger">
        Te quedan <?= 380 - $_SESSION['mi_equipo']->getCreditos_gastados() ?> creditos
      </div>

      <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
      <form action="inicio.php?accion=guardar&evento=seleccionar_jugadores&tabla=mi_equipo" method="POST">
        <div class="form-group">
          <label for="nombre">Selecciona Jugador </label>
          <select required class="form-select mb-4" aria-label="Default select example" name="codigo_jugador">
            <?php
            foreach ($jugadores as $jugador) {
              if (
                !$modelo->exist($jugador->getCodigo_jugador())
                && !$_SESSION['equipo'][$jugador->getCodigo_jugador()]
              ) {
                echo "<option value='{$jugador->getCodigo_jugador()}'>{$jugador->getCodigo_jugador()} - {$jugador->getNombre()}</option>";
              }
            }
            ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Añadir Jugador</button>
        <a class="btn btn-danger" href="inicio.php">Cancelar</a>
      </form>
    </div>
  <?php
  } else {
  ?>
    <div class="alert alert-danger"> No te quedan creditos, cambia los jugadores </div>
  <?php
  }
  
} else {
  ?>
  <div class="alert alert-danger"> No puedes modificar el equipo, porque ya lo tienes o porque aun no lo has creado </div>
<?php
}
