<?php
require_once('config/db.php');
//require_once('class/persona.php');

class VendedorModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    public function insert(array $vendedor): ?string //devuelve string o null
    {
        try {
            $sql = "INSERT INTO vendedor(numvend, nomvend, nombrecomer, telefono, calle, ciudad, provincia, cod_postal)";
            $sql .= "  VALUES (:numvend,:nomvend,:nombrecomer,:telefono,:calle,:ciudad,:provincia,:cod_postal);";
            $sentencia = $this->conexion->prepare($sql);
            $arrayDatos = [
                ":numvend"      => $vendedor["numvend"],
                ":nomvend"      => $vendedor["nomvend"],
                ":nombrecomer"  => $vendedor["nombrecomer"],
                ":telefono"     => $vendedor["telefono"],
                ":calle"        => $vendedor["calle"],
                ":ciudad"       => $vendedor["ciudad"],
                ":provincia"    => $vendedor["provincia"],
                ":cod_postal"   => $vendedor["cod_postal"]
            ];

            $resultado = $sentencia->execute($arrayDatos);
            return ($resultado == true) ? $vendedor["numvend"] : null;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return null;
        }
    }

    public function read(string $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM vendedor WHERE numvend=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devulve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null;
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $vendedor = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($vendedor == false) ? null : $vendedor;
    }

    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM vendedor");
        //usamos método query
        $vendedores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $vendedores;
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM vendedor WHERE numvend =:id";
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
    }

    public function edit(array $vendedor): bool
    {
        try {
            $sql = "UPDATE vendedor SET numvend = :numvend, nomvend=:nomvend, nombrecomer=:nombrecomer, telefono=:telefono";
            $sql .= ", calle=:calle, ciudad=:ciudad, ciudad=:ciudad, ciudad=:ciudad, cod_postal=:cod_postal";
            $sql .= " WHERE numvend = :numvend;";
            $arrayDatos = [
                ":numvend"      => $vendedor["numvend"],
                ":nomvend"      => $vendedor["nomvend"],
                ":nombrecomer"  => $vendedor["nombrecomer"],
                ":telefono"     => $vendedor["telefono"],
                ":calle"        => $vendedor["calle"],
                ":ciudad"       => $vendedor["ciudad"],
                ":provincia"    => $vendedor["provincia"],
                ":cod_postal"   => $vendedor["cod_postal"]
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

    // public function search(string $dato): array
    // {
    //     $sentencia = $this->conexion->prepare("SELECT * FROM pedido WHERE numpedido LIKE :dato");
    //     //ojo el si ponemos % siempre en comillas dobles "
    //     $arrayDatos = [":dato" => "%$dato%"];
    //     $resultado = $sentencia->execute($arrayDatos);
    //     if (!$resultado) return [];
    //     $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //     return $pedidos;
    // }
}
