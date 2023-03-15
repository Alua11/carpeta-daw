<?php
require_once "Models/autoloader.php";
require_once('config/db.php');
class PersonaModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    //o Persona p1
    public function insert(array $persona): ?int //devuelvo entero o null
    {
        $sql = "INSERT INTO personas(usuario, password, nombre, apellidos, genero) VALUES (?, ?, ?, ?, ?);";
        $sentencia = $this->conexion->prepare($sql);
        $arrayDatos = [
            $persona["usuario"],
            $persona["password"],
            $persona["nombre"],
            $persona["apellidos"],
            $persona["genero"]
        ];
        $resultado = $sentencia->execute($arrayDatos);
        /*Pasar en el mismo orden de los ? execute devuelve un booleano.
        True en caso de que todo vaya bien, falso en caso contrario.*/
        //Así podriamos evaluar
        return ($resultado == true) ? $this->conexion->lastInsertId() : null;
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM personas WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devulve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null; //Este if no es necesario, puesto que se controla bajo.
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $persona = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay persona
        return ($persona == false) ? null : $persona;
    }

    //En este caso, el array, devuelto es un array asociativo.
    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM personas;");
        //usamos método query
        $personas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $personas;
    }

    public function readAllversionClass(): array
    {
        $consulta_prep = $this->conexion->prepare("SELECT * FROM personas");
        $consulta_prep->setFetchMode(PDO::FETCH_CLASS, 'Personas');
        $consulta_prep->execute();
        $personas = $consulta_prep->fetchAll();
        return $personas;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM personas WHERE id =:id";
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
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function edit(int $idAntiguo, array $arrayPersona): bool
    {
        try {
            $sql = "UPDATE personas SET nombre = :nombre, apellidos = :apellidos, genero = :genero, ";
            $sql .= "usuario = :usuario, password= :password ";
            $sql .= " WHERE id = :id;";
            $arrayDatos = [
                ":id" => $idAntiguo,
                ":usuario" => $arrayPersona["usuario"],
                ":password" => $arrayPersona["password"],
                ":nombre" => $arrayPersona["nombre"],
                ":apellidos" => $arrayPersona["apellidos"],
                ":genero" => $arrayPersona["genero"],
            ];
            $sentencia = $this->conexion->prepare($sql);
            return $sentencia->execute($arrayDatos);
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function search(string $campo, string $tipo, string $textoBuscar): array
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM personas WHERE {$campo} LIKE :textoBuscar");
        //ojo el si ponemos % siempre en comillas dobles "
        switch ($tipo) {
            case "inicio":
                $arrayDatos = [":textoBuscar" => "$textoBuscar%"];
                break;
            case "final":
                $arrayDatos = [":textoBuscar" => "%$textoBuscar"];
                break;
            case "igual":
                $arrayDatos = [":textoBuscar" => "$textoBuscar"];
            case "contiene":
            case "default":
                $arrayDatos = [":textoBuscar" => "%$textoBuscar%"];
                break;
        }
        
        $resultado = $sentencia->execute($arrayDatos);
        if (!$resultado) return [];
        $personas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $personas;
    }

    // public function search(string $campo, string $accion, string $textoBuscar): array
    // {
    //     $sentencia = $this->conexion->prepare("SELECT * FROM personas WHERE usuario LIKE :usuario");
    //     //ojo el si ponemos % siempre en comillas dobles "
    //      swithc (accion) {
        //  case "contiene":
            //$arrayDatos = [":usuario" => "%$usuario%"];
            //break;
            //default:
            //$arrayDatos = [":usuario" => "%$usuario%"];
            //break;
    //}
    //     $arrayDatos = [":usuario" => "%$usuario%"];
    //     $resultado = $sentencia->execute($arrayDatos);
    //     if (!$resultado) return [];
    //     $personas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //     return $personas;
    // }
}
