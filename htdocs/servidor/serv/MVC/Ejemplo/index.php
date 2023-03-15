<?php
require_once("views/menu/head.php");
if (isset($_REQUEST["accion"])) {
    switch ($_REQUEST["accion"]) {
        case "crear":
            require_once("views/persona/create.php");
            break;
        case "guardar":
            require_once("views/persona/store.php");
            break;
        case "ver":
            require_once("views/persona/show.php");
            break;
        case "listar":
            require_once("views/persona/list.php");
            break;
        case "listar2":
            require_once("views/persona/listv2.php");
            break;
        case "buscar":
            require_once("views/persona/search.php");
            break;
        case "borrar":
            require_once("views/persona/delete.php");
            break;
        case "editar":
            require_once("views/persona/edit.php");
            break;
        default:
            require_once("views/404.php");
            break;
    }
} else { // Vista Por defecto
?>
    <a href="index.php?accion=crear" class="btn btn-primary">Agregar Usuario</a>
<?php
}
require_once("views/menu/footer.php");
