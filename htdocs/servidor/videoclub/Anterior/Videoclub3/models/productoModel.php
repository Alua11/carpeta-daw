<?php
require_once('config/db.php');
require_once('models/Class/Juego.php');
require_once('models/Class/CD.php');
require_once('models/Class/Pelicula.php');

class ProductoModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    //o Persona p1
    public function insert(array $producto): bool //devuelvo entero o null
    {
        ($producto['tipo'] == 'juego')? $productoObj = new Juego($producto):null;
        ($producto['tipo'] == 'CD')? $productoObj = new CD($producto):null;
        ($producto['tipo'] == 'pelicula')? $productoObj = new Pelicula($producto):null;
        try {
            return true;
        } catch (Exception $e) {
            return false;
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
        return $_SESSION['videoclub']->getProductos();
    }
    public function readAllBBDD(): array
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

    public function exists(string $campo):bool
    {
        
        foreach($_SESSION['videoclub'] as $producto){
            echo $producto;
        }
        return false;
    }
}
