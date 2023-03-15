<?php
require_once "controllers/clientesController.php";
require_once "controllers/alquiladosController.php";
require_once "controllers/productosController.php";

if (!isset($_REQUEST['id'])) {
    header("location:index.php");
}



$idProducto = $_REQUEST['id'];
$controllerPro = new ProductosController();
$producto = $controllerPro->ver($idProducto);

$todosClientes =  $_SESSION['videoclub']->getClientes();

if (isset($_REQUEST['alquilarButton'])){
    $controladorAl = new AlquiladosController();
    $lastIdAlquilado = $controladorAl->lastId()+1;
    $date = date('Y-m-d');
    $arrayAlquilado = [
        'id' => $lastIdAlquilado,
        'id_cliente' => $_REQUEST['cliente'],
        'id_producto' => $producto->getID(),
        'fecha_inicio' => $date
    ];
    $nuevoAlquiler = new Alquilado($arrayAlquilado);

    $_SESSION['videoclub']->setAlquilado($nuevoAlquiler);
    header("location:index.php");
}

?>
<div class="w-75" style="margin: 0 auto">
<br><br>
<div>
    <p>Alquilar <b><?= $producto->getNombre() ?></b></p>
</div>
<form href="index.php?accion=alquileresProducto&tabla=producto&id=<?= $idProducto ?>" method="POST">
    <select required class="form-select mb-3" aria-label="Default select example" name="cliente">
        <?php
            foreach($todosClientes as $cliente){
                echo '
                    <option value="'.$cliente->getID().'">'.$cliente->getNombre().' '.$cliente->getApellido1().' '.$cliente->getApellido2().'</option>
                ';
            }
        ?>

</select>
<button name="alquilarButton" id="alquilarButton" type="submit" class="btn btn-primary">Alquilar</button>

</form>
        </div>