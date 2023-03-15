<?php
require_once "Models/autoloader.php";
require_once('config/db.php');

class DigimonModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = db::conexion();
    }
    //o digimon p1
    public function insert(array $digimon): ?int //devuelvo entero o null
    {
        $sql = "INSERT INTO digimon(nombre, ataque, defensa, tipo, nivel) VALUES (?, ?, ?, ?, ?);";
        $sentencia = $this->conexion->prepare($sql);
        $arrayDatos = [
            $digimon["nombre"],
            $digimon["ataque"],
            $digimon["defensa"],
            $digimon["tipo"],
            $digimon["nivel"]
        ];
        $resultado = $sentencia->execute($arrayDatos);
        /*Pasar en el mismo orden de los ? execute devuelve un booleano.
        True en caso de que todo vaya bien, falso en caso contrario.*/
        //Así podriamos evaluar
        return ($resultado == true) ? $this->conexion->lastInsertId() : null;
    }

    public function read(int $id): ?stdClass
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM digimon WHERE id=:id");
        $arrayDatos = [":id" => $id];
        $resultado = $sentencia->execute($arrayDatos);
        // ojo devulve true si la consulta se ejecuta correctamente
        // eso no quiere decir que hayan resultados
        if (!$resultado) return null; //Este if no es necesario, puesto que se controla bajo.
        //como sólo va a devolver un resultado uso fetch
        // DE Paso probamos el FETCH_OBJ
        $digimon = $sentencia->fetch(PDO::FETCH_OBJ);
        //fetch duevelve el objeto stardar o false si no hay digimon
        return ($digimon == false) ? null : $digimon;
    }

    //En este caso, el array, devuelto es un array asociativo.
    public function readAll(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM digimon;");
        //usamos método query
        $digimons = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $digimons;
    }

    public function readAllversionClass(): array
    {
        $consulta_prep = $this->conexion->prepare("SELECT * FROM digimon");
        $consulta_prep->setFetchMode(PDO::FETCH_CLASS, 'Digimon');
        $consulta_prep->execute();
        $digimon = $consulta_prep->fetchAll();
        return $digimon;
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM digimon WHERE id =:id";
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

    public function edit(int $idAntiguo, array $arrayDigimon): bool
    {
        try {
            $sql = "UPDATE digimon SET ataque = :ataque, defensa = :defensa, tipo = :tipo, nivel = :nivel, ";
            $sql .= "nombre = :nombre ";
            $sql .= " WHERE id = :id;";
            $arrayDatos = [
                ":id" => $idAntiguo,
                ":nombre" => $arrayDigimon["nombre"],
                ":ataque" => $arrayDigimon["ataque"],
                ":defensa" => $arrayDigimon["defensa"],
                ":tipo" => $arrayDigimon["tipo"],
                ":nivel" => $arrayDigimon["nivel"]
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
        $sentencia = $this->conexion->prepare("SELECT * FROM digimon WHERE {$campo} LIKE :textoBuscar");
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
        $digimon = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $digimon;
    }
}
