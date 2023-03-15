<?php
require_once('config/db.php');

class AlquiladoModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    //o Persona p1
   /*  public function insert(array $alquilado): ?string //devuelvo entero o null
    {
        try {
            $sql = "INSERT INTO alquilado(id_cliente, id_producto, fecha_inicio, fecha_fin)  VALUES (:idCli,:idPro,:inicio,:fin);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":idCli" => $alquilado["id_cliente"],
                ":idPro" => $alquilado["id_producto"],
                ":inicio" => $alquilado["fecha_inicio"],
                ":fin" => $alquilado["fecha_fin"]
            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $this->conexion->lastInsertId() : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    } */

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
    /* public function delete(string $id): bool
    {
        $sql = "DELETE FROM piezas WHERE numpieza =:id";
        try {
            $sentencia = $this->conexion->prepare($sql);
            //devuelve true si se borra correctamente
            //false si falla el borrado
            // Pero, si el id existe el borrado es correcto
            // Pero no borra
            $resultado = $sentencia->execute([":id" => $id]);
            // Si no ha borrado nada considero borrado error
            return ($sentencia->rowCount() <= 0) ? false : true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    } */

    /* public function edit(string $idAntiguo, array $pieza): bool
    {
        try {
            $sql = "UPDATE piezas SET numpieza = :numpi, nompieza=:nompi, preciovent=:precio";
            $sql .= " WHERE numpieza = :idantiguo;";
            $arrayDatos = [
                ":numpi" => $pieza["numpieza"],
                ":nompi" => $pieza["nompieza"],
                ":precio" => $pieza["preciovent"],
                ":idantiguo" => $idAntiguo,
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    } */

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

    /*  public function exist(string $campo, string $valor): bool
    {
        switch ($campo) {
            case 'id':
                foreach ($_SESSION['videoclub']->getAlquilados() as $alquilado) {
                    if ($alquilado->getID() == $valor) return true;
                }
                break;
            case 'dni':
                foreach ($_SESSION['videoclub']->getAlquilados() as $alquilado) {
                    if ($alquilado->getDNI() == $valor) return true;
                }
                break;
        }
        return false;
    } */

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
