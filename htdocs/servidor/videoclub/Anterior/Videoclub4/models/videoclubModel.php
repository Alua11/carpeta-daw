<?php
require_once('config/db.php');

class VideoclubModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function save(Videoclub $videoclub)
    {
        $arrayTablas = ['cliente', 'producto', 'alquilado'];
            $sql = "TRUNCATE TABLE `cliente`";
            try {
                $sentencia = $this->conexion->prepare($sql);
                $resultado = $sentencia->execute();
                return ($sentencia->rowCount() <= 0) ? false : true;
            } catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
                return false;
            }
        /*
        try {
            // GUARDAR
            foreach ($_SESSION['videoclub']->getProductos() as $producto) {
                $sql = "INSERT INTO producto VALUES (?,?,?,?,?,?,?,?)";
                $sentencia = $this->conexion->prepare($sql);
                $resultado = $sentencia->execute([
                    $producto->getID(),
                    $producto->getNombre(),
                    $producto->getPrecio(),
                    $producto->getTipo(),
                    $producto->getPlataforma(),
                    $producto->getIdioma(),
                    $producto->getDuracion(),
                    $producto->getGenero(),
                ]);
            }
            return true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }*/
    }
}
