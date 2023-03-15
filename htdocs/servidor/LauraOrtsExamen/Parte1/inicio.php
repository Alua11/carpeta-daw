<?php
require_once("./models/Class/Mi_Equipo.php");
require_once("./models/mi_equipoModel.php");
require_once "config/db.php";
session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION = [];
    unset($_SESSION);
    session_destroy();
    header("location:login.php");
    exit();
} else {
    $conexion = db::conexion();

    $miEquipo = false;
    $sql = "SELECT * FROM mi_equipo WHERE nick_socio=:user";
    $sentencia = $conexion->prepare($sql);
    $arrayDatos2 = [
        ":user" => "{$_SESSION['usuario']}"
    ];
    $resultado = $sentencia->execute($arrayDatos2);
    if ($resultado != false) {
        $miEquipo = $sentencia->fetch(PDO::FETCH_OBJ);
    }
    if ($miEquipo != false) {
        $datos = [
            'codigo_mi_equipo'  => $miEquipo->codigo_mi_equipo,
            'nombre'            => $miEquipo->nombre,
            'creditos_gastados' => $miEquipo->creditos_gastados,
            'nick_socio'        => $miEquipo->nick_socio,
            'fichajes_hechos'   => $miEquipo->fichajes_hechos
        ];
        $_SESSION['mi_equipo'] = new Mi_Equipo($datos);
    }
}

require_once("views/menu/head.php");

$tablasValidas = ["mi_equipo", "jugadores"];

if (isset($_REQUEST["tabla"], $_REQUEST["accion"])) {
    $tabla = $_REQUEST["tabla"];
    if (!in_array($tabla, $tablasValidas)) {
        require_once("views/404.php");
    } else {
        switch ($_REQUEST["accion"]) {
            case "crear_equipo":
                require_once("views/$tabla/crear_equipo.php");
                break;
            case "seleccionar_jugadores":
                require_once("views/$tabla/seleccionar_jugadores.php");
                break;
            case "guardar":
                require_once("views/$tabla/store.php");
                break;
            case "ver":
                require_once("views/$tabla/show.php");
                break;
            default:
                require_once("views/404.php");
                break;
        }
    }
} else if (substr($_SERVER["REQUEST_URI"], -10) == "inicio.php" || substr($_SERVER["REQUEST_URI"], -1) == "/") {
?>
    <p class="m-3 mt-0">Buenas</p>
<?php
} else require_once("views/404.php");

require_once("views/menu/footer.php");
