<?php
require_once('config/db.php');

class AlquiladoModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function read(string $id): ?Alquilado
    {
        return $_SESSION['videoclub']->getAlquilados()[$id - 1];
    }
    public function readAll(): array
    {
        return $_SESSION['videoclub']->getAlquilados();
    }
    public function readAllBBDD(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM alquilado;");
        $cliente = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $cliente;
    }

    public function search(string $campo, string $dato): array
    {
        $alquilados = $_SESSION['videoclub']->getAlquilados();
        $encontrados = [];
        foreach ($alquilados as $alquilado) {
            switch ($campo) {
                case "id":
                    if ($alquilado->getID() == $dato) $encontrados[] = $alquilado;
                    break;
                case "id_cliente":
                    if ($alquilado->getIdCliente() == $dato) $encontrados[] = $alquilado;
                    break;
                case "id_producto":
                    if ($alquilado->getIdProducto() == $dato) $encontrados[] = $alquilado;
                    break;
                case "fecha_inicio":
                    if ($alquilado->getFechaInicio() == $dato) $encontrados[] = $alquilado;
                    break;
                case "fecha_fin":
                    if ($alquilado->getFechaFin() == $dato) $encontrados[] = $alquilado;
                    break;
            }
        }
        return $encontrados;
    }

    public function devolver($id) {
        foreach ($_SESSION['videoclub']->getAlquilados() as $key => $alquiler) {
            if ($alquiler->getID() == $id) {
                $date = date('Y-m-d');
                $_SESSION['videoclub']->getAlquilados()[$key]->setFechaFin($date);
                return true;
            }
        }
        return false;
    }
}
