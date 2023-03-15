<?php
require_once('config/db.php');

class LinpedModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function search(string $dato): array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM linped WHERE numpieza = :dato");
        //ojo el si ponemos % siempre en comillas dobles "
        $arrayDatos = [":dato" => $dato];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        $linped = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $linped;
    }
}