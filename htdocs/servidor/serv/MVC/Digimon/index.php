<?php
require_once("views/menu/head.php");
if (isset($_REQUEST["accion"])) {
    switch ($_REQUEST["accion"]) {
        case "crear":
            require_once("views/digimon/create.php");
            break;
        case "guardar":
            require_once("views/digimon/store.php");
            break;
        case "ver":
            require_once("views/digimon/show.php");
            break;
        case "listar":
            require_once("views/digimon/list.php");
            break;
        case "listar2":
            require_once("views/digimon/listv2.php");
            break;
        case "buscar":
            require_once("views/digimon/search.php");
            break;
        case "borrar":
            require_once("views/digimon/delete.php");
            break;
        case "editar":
            require_once("views/digimon/edit.php");
            break;
        default:
            require_once("views/404.php");
            break;
    }
} else { //Vista por defecto
?>
    <a href="index.php?accion=crear" class="btn btn-primary">Agregar Digimon</a>
<?php
}
require_once("views/menu/footer.php");
