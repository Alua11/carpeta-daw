<?php
require_once "controller/personasController.php";
if (!isset($_REQUEST['id'])) {
    header("location:index.php");
}
$id = $_REQUEST['id'];
$controlador = new PersonasController();
$persona = $controlador->ver($id);
if ($persona != null) {

?>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Persona: ID: <?= $persona->id ?> USUARIO: <?= $persona->usuario ?></h5>
        <p class="card-text">
            Nombre: <?= $persona->nombre ?> <?= $persona->apellidos ?>
            Genero: <?= ($persona->genero == "M" ? "Masculino" : "Femenino") ?>
        </p>
        <a href="index.php" class="btn btn-primary">Volver a Inicio</a>
    </div>
</div>
<?php
} else {
    echo "No existe Persona";
}