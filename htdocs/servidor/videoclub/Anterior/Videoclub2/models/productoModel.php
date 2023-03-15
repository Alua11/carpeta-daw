<?php
require_once('config/db.php');

class ProductoModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    //o Persona p1
    public function insert(array $producto): ?string //devuelvo entero o null
    {
    try {
        $sql = "INSERT INTO producto(numpieza, nompieza, preciovent)  VALUES (:numpi,:nompi,:precio);";
        $sentencia = $this->conexion->prepare($sql);
        $arrayDatos = [
            ":numpi"=>$producto["numpieza"],
            ":nompi"=>$producto["nompieza"],
            ":precio"=>$producto["preciovent"]
        ];
        $resultado = $sentencia->execute($arrayDatos);
        return ($resultado == true) ? $producto["numpieza"] : null;
        
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
        return null;
    }
}

    public function read(string $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM producto WHERE numpieza=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devulve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $pieza = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($pieza == false) ? null : $pieza;
    }

    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM producto;");
        $producto = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $producto;
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM producto WHERE id =:id";
        try {
            $sentencia = $this->conexion->prepare($sql);
            $resultado = $sentencia->execute([":id" => $id]);
            return ($sentencia->rowCount() <= 0) ? false : true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

    /*
    public function edit(string $idAntiguo, array $pieza): bool
    {
        try {
            $sql = "UPDATE piezas SET numpieza = :numpi, nompieza=:nompi, preciovent=:precio";
            $sql .= " WHERE numpieza = :idantiguo;";
            $arrayDatos = [
                ":numpi"=>$pieza["numpieza"],
                ":nompi"=>$pieza["nompieza"],
                ":precio"=>$pieza["preciovent"],
                ":idantiguo"=>$idAntiguo,
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }
    */

    public function search(string $dato): array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM producto WHERE nombre LIKE :dato");
        //% siempre en comillas dobles "
        $arrayDatos = [":dato" => "%$dato%"];
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        $producto = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $producto;
    }

    public function exists(string $campo, string $valor):bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM producto WHERE $campo=:valor");
        $arrayDatos = [":valor" => $valor];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount()<=0)?false:true;
    }
}
