<?php
require_once("views/menu/head.php");
require_once("./models/Class/Videoclub.php");

session_start();

$tablasValidas = ["producto", "cliente", "bbdd", "alquilado"];

if (isset($_REQUEST["tabla"], $_REQUEST["accion"])) {
    $tabla = $_REQUEST["tabla"];
    if (!in_array($tabla, $tablasValidas)) {
        require_once("views/404.php");
    } else {
        switch ($_REQUEST["accion"]) {
            case "crear":
                require_once("views/$tabla/create.php");
                break;
            case "guardar":
                require_once("views/$tabla/store.php");
                break;
            case "ver":
                require_once("views/$tabla/show.php");
                break;
            case "listar":
                require_once("views/$tabla/list.php");
                break;
            case "buscar":
                require_once("views/$tabla/search.php");
                break;
            case "borrar":
                require_once("views/$tabla/delete.php");
                break;
            case "editar":
                require_once("views/$tabla/edit.php");
                break;
            case "guardarBBDD":
                require_once("views/$tabla/guardar.php");
                break;
            case "alquileresCliente":
                require_once("views/$tabla/alquilado.php");
                break;
            case "alquileresProducto":
                require_once("views/$tabla/alquilar.php");
                break;
            case "devolver":
                require_once("views/$tabla/devolver.php");
                break;
            default:
                require_once("views/404.php");
                break;
        }
    }
} else if (substr($_SERVER["REQUEST_URI"], -9) == "index.php" || substr($_SERVER["REQUEST_URI"], -1) == "/") { // Vista Por defecto
    if(!isset($_SESSION['videoclub'])) {
        $videoclubObj = new Videoclub();
        $_SESSION['videoclub'] = $videoclubObj;        
    }
?>
<p class="m-3 mt-0">Bienvenido al videoclub</p>
<?php
}else require_once("views/404.php");

require_once("views/menu/footer.php");
