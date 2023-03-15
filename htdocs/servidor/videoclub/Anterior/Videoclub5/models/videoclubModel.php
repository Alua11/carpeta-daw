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
        $arrayTablas = ['alquilado', 'producto', 'cliente'];
            foreach($arrayTablas as $tabla){
                try {
                    $sql = "TRUNCATE TABLE ${tabla}";
                    $statement = $this->conexion->prepare($sql);
                    $statement->execute();
                } catch (Exception $e) {
                    echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
                    return false;
                }
            }
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

            foreach ($_SESSION['videoclub']->getClientes() as $cliente) {
                $sql = "INSERT INTO cliente VALUES (?,?,?,?,?)";
                $sentencia = $this->conexion->prepare($sql);
                $resultado = $sentencia->execute([
                    $cliente->getID(),
                    $cliente->getDNI(),
                    $cliente->getNombre(),
                    $cliente->getApellido1(),
                    $cliente->getApellido2()
                ]);
            }

            foreach ($_SESSION['videoclub']->getAlquilados() as $alquilado) {
                $sql = "INSERT INTO alquilado VALUES (?,?,?,?,?)";
                $sentencia = $this->conexion->prepare($sql);
                $resultado = $sentencia->execute([
                    $alquilado->getID(),
                    $alquilado->getIdCliente(),
                    $alquilado->getIdProducto(),
                    $alquilado->getFechaInicio(),
                    $alquilado->getFechaFin()
                ]);
            }
            return true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }
}
