<?php
require_once "assets/php/funciones.php";
require_once('config/db.php');

class ClienteModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert(array $cliente): ?string //devuelvo entero o null
    {
        try {
            $sql = "INSERT INTO cliente(dni, nombre, apellido1, apellido2)  VALUES (:dni,:nombre,:ap1,:ap2);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":dni" => $cliente["dni"],
                ":nombre" => $cliente["nombre"],
                ":ap1" => $cliente["apellido1"],
                ":ap2" => $cliente["apellido2"]
            ];
            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $this->conexion->lastInsertId() : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function read(string $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM cliente WHERE id=:id");
        $arrayDatos = [":id" => $id];

        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return null;

        $cliente = $sentencia->fetch(PDO::FETCH_OBJ);
        
        return ($cliente == false) ? null : $cliente;
    }

    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM cliente;");
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

    public function search(string $campo, string $metodoBusqueda, string $dato): array
    {
        switch ($metodoBusqueda) {
            case "inicio":
                $arrayDatos = [":dato" => "$dato%"];
                break;
            case "final":
                $arrayDatos = [":dato" => "%$dato"];
                break;
            case "igual":
                $arrayDatos = [":dato" => "$dato"];
            case "contiene":
            case "default":
                $arrayDatos = [":dato" => "%$dato%"];
                break;
        }

        $sentencia = $this->conexion->prepare("SELECT * FROM cliente WHERE $campo LIKE :dato");
        //ojo el si ponemos % siempre en comillas dobles "
        $arrayDatos = [":dato" => "%$dato%"];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        $clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $clientes;
    }

    public function exist(string $campo, string $valor): bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM cliente WHERE $campo = :valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount()) <= 0 ? false : true;
    }
}
