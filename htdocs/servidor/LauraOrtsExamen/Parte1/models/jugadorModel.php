<?php
require_once "assets/php/funciones.php";
require_once("./models/Class/Jugador.php");
require_once('config/db.php');

class JugadorModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = db::conexion();
    }

    /*  public function insert(array $arrayCliente): ?string //devuelvo entero o null
    {
        $id = count($_SESSION['videoclub']->getClientes()) + 1;
        $cliente = new Cliente($id, $arrayCliente);
        $_SESSION['videoclub']->setCliente($cliente);
        return $cliente->getID();
    } */

    /* public function read(string $id): ?Mi_Equipo
    {
        return $_SESSION['videoclub']->getClientes()[$id - 1];
    } */

    public function readAll(): array
    {
        $sql = "SELECT * FROM jugadores";
        $sentencia = $this->conexion->prepare($sql);
        $resultado = $sentencia->execute();
        if ($resultado != false) {
            $jugadores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
        $array = [];
        if ($jugadores != false) {
            foreach ($jugadores as $jugador) {
                $array[$jugador['codigo_jugador']] = new Jugador($jugador);
            }
        }
        return $array;
    }
    /* public function readAllBBDD(): array
    {
        $sentencia = $this->conexion->query("SELECT * FROM cliente;");
        $cliente = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $cliente;
    } */

    /*  public function delete(string $id): bool
    {
        $clientes = $_SESSION['videoclub']->getClientes();
        foreach ($clientes as $key => $cliente) {
            if ($cliente->getID() == $id) {
                unset($clientes[$key]);
                $_SESSION['videoclub']->setClientes($clientes);
                return true;
            }
        }
        return false;
    
    } */

    /*  public function edit(string $idAntiguo, array $array): bool
    {
        $cliente = $_SESSION['videoclub']->getClientes()[$idAntiguo - 1];
        $cliente->setDNI($array['dni']);
        $cliente->setNombre($array['nombre']);
        $cliente->setApellido1($array['apellido1']);
        $cliente->setApellido2($array['apellido2']);
        return true;
    } */

    /* public function search(string $campo, string $dato): array
    {
        $clientes = $_SESSION['videoclub']->getClientes();
        $clientesEncontrados = [];
        foreach ($clientes as $cliente) {
            switch ($campo) {
                case "id":
                    if($cliente->getID() == $dato) $clientesEncontrados[] = $cliente;
                    break;
                case "dni":
                    if ($cliente->getDNI() == $dato) $clientesEncontrados[] = $cliente;
                    break;
                case "nombre":
                    if ($cliente->getNombre() == $dato) $clientesEncontrados[] = $cliente;
                    break;
                case "apellido1":
                    if ($cliente->getApellido1() == $dato) $clientesEncontrados[] = $cliente;
                    break;
                case "apellido2":
                    if ($cliente->getApellido2() == $dato) $clientesEncontrados[] = $cliente;
                    break;
            }
        }
        return $clientesEncontrados;
    } */

    public function exist($codigo_jugador): bool
    {
        $sentencia = $this->conexion->prepare("SELECT * FROM mis_jugadores_de_mi_equipo WHERE codigo_jugador=:valor");
        $arrayDatos = [":valor" => $codigo_jugador];
        $resultado = $sentencia->execute($arrayDatos);
        return (!$resultado || $sentencia->rowCount() <= 0) ? false : true;
    }
}
