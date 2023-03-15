<?php
session_start();
require_once "config/db.php";
$usuario = "";
$password = "";
$visibilidad = "invisible";
$msg = "";
$clase = "";
$conexion = db::conexion();
if (isset($_POST["user"])) {
    $usuario = $_POST["user"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM socios WHERE nick=:user and contrasenya=:pass";
    $sentencia = $conexion->prepare($sql);
    $arrayDatos = [
        ":user" => $usuario,
        "pass" => $password
    ];
    $resultado = $sentencia->execute($arrayDatos);
    if ($resultado && $sentencia->rowCount() >= 1) {
        $_SESSION['usuario'] = $usuario;
        header("location:inicio.php");
        exit();
    }
    //falló
    $_SESSION = [];
    $visibilidad = "visible";
    $msg = "Usuario o contraseña no Validos";
    $clase = "alert_danger";
}
?>

<body>
    <div class="card-header text-center">
        <b>Login examen</b>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Logueate para entrar en la apliación</p>
        <div class="alert alert-danger <?= $visibilidad ?>"><?= $msg ?></div>

        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <div class="input-group mb-3">
                <input type="text" name="user" class="form-control" value="<?= $usuario ?>" placeholder="Usuario">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" value="<?= $password ?>" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <button type="submit" class="btn btn-primary btn-block"> Comprobar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
</body>

</html>