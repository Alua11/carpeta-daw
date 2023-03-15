<?php
require_once('config/db.php');

class VideoclubModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function save(Videoclub $videoclub): bool
    {
        $arrayTablas = ['cliente','producto','alquilado'];
        foreach($arrayTablas as $tabla){
            echo "model";
            $sql = "TRUNCATE TABLE {$tabla}";
            try {
                $sentencia = $this->conexion->prepare($sql);
                $resultado = $sentencia->execute();
                return ($sentencia->rowCount() <= 0) ? false : true;
            } catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
                return false;
            }
        }
        //GUARDAR
    }

}
