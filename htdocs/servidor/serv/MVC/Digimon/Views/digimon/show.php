<?php
require_once "controller/digimonsController.php";
if (!isset($_REQUEST['id'])) {
    header("location:index.php");
}
$id = $_REQUEST['id'];
$controlador = new DigimonsController();
$digimon = $controlador->ver($id);
if ($digimon != null) {

?>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Digimon: ID: <?= $digimon->id ?> Nombre: <?= $digimon->nombre ?></h5>
            <p class="card-text">
                Nombre: <?= $digimon->nombre ?>
                Ataque: <?= $digimon->ataque ?> Defensa: <?= $digimon->defensa ?>
                Tipo: <?= $digimon->tipo ?> Nivel: <?= $digimon->nivel ?>
            </p>
            <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
        </div>
    </div>
<?php
} else {
    echo "No existe Digimon";
}
