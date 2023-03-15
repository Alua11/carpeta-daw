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
    public function insert(array $producto) //devuelvo entero o null
    {
        try {
            ($producto['tipo'] == 'juego')? $productoObj = new Juego($producto):null;
            ($producto['tipo'] == 'CD')? $productoObj = new CD($producto):null;
            ($producto['tipo'] == 'pelicula')? $productoObj = new Pelicula($producto):null;
            echo "<pre>";
            var_dump($productoObj);
            $_SESSION['videoclub']->setProducto($productoObj);
            $controller = new ProductosController();
            return $controller->lastId();
        } catch (Exception $e) {
            return false;
        }
    }

    public function read(string $id)
    {
        foreach ($_SESSION['videoclub']->getProductos() as $producto) {
            if ($producto->getID() == $id) {
                return $producto;
            }
        }
        return null;
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
        try {
            $indice = 0;
            foreach($_SESSION['videoclub']->getProductos() as $producto){
                if($producto->getID() == $id){
                    $allProducts = $_SESSION['videoclub']->getProductos();
                    unset($allProducts[$indice]);
                    $_SESSION['videoclub']->setProductos($allProducts);
                    return true;
                }
                $indice++;
            }
            return true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

    public function edit(string $idAntiguo, array $productoEntregado): bool
    {
        try {
            $allProducts = $_SESSION['videoclub']->getProductos();
            foreach($allProducts as $producto){
                if($idAntiguo == $producto->getID()){
                    $producto->setNombre($productoEntregado['nombre']);
                    $producto->setPrecio($productoEntregado['precio']);
                    $producto->setGenero($productoEntregado['genero']);
                    (isset($productoEntregado['idioma']))?$producto->setIdioma($productoEntregado['idioma']):null;
                    (isset($productoEntregado['duracion']))?$producto->setDuracion($productoEntregado['duracion']):null;
                    (isset($productoEntregado['plataforma']))?$producto->setPlataforma($productoEntregado['plataforma']):null;
                }
            }
            return true;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "<bR>";
            return false;
        }
    }

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
