<?php
require_once "./assets/php/funciones.php";
require_once("./models/clienteModel.php");
require_once("./models/productoModel.php");
require_once("./models/alquiladoModel.php");
require_once("./models/Class/Cliente.php");
require_once("./models/Class/Producto.php");
require_once("./models/Class/Alquilado.php");

class Videoclub {
    private $clientes = [];
    private $productos = [];
    private $alquilados = [];

    public function __construct()
    {
        $clienteModelObj = new ClienteModel();
        $productoModelObj = new ProductoModel();
        $alquiladoModelObj = new AlquiladoModel();

        $todosLosClientes = $clienteModelObj->readAllBBDD();
        $todosLosProductos = $productoModelObj->readAllBBDD();
        $todosLosAlquilados = $alquiladoModelObj->readAllBBDD();

        foreach($todosLosClientes as $id => $cliente){
            $clienteObj = new Cliente($id + 1, $cliente);
            $this->setCliente($clienteObj);
        }

        foreach($todosLosProductos as $producto){
            if($producto['tipo'] == 'juego'){ $productoObj = new Juego($producto); }
            if($producto['tipo'] == 'cd'){ $productoObj = new CD($producto); }
            if($producto['tipo'] == 'pelicula'){ $productoObj = new Pelicula($producto); }
            $this->setProducto($productoObj);
        }

        foreach($todosLosAlquilados as $alquilado){
            $alquiladoObj = new Alquilado($alquilado);
            $this->setAlquilado($alquiladoObj);
        }

    }

    public function __toString()
    {
        $cadena = '';
        foreach ($this->clientes as $cliente) {
            $cadena .= $cliente . "<br>";
        }
        foreach ($this->productos as $producto) {
            $cadena .= $producto . "<br>";
        }
        return $cadena;
    }

    public function getClientes() {
        return $this->clientes;
    }
    public function getProductos() {
        return $this->productos;
    }
    public function getAlquilados() {
        return $this->alquilados;
    }

    public function setClientes(array $clientes) {
        $this->clientes = $clientes;
    }
    public function setProductos(array $productos) {
        $this->productos = $productos;
    }
    public function setAlquilados(array $alquilados) {
        $this->alquilados = $alquilados;
    }

    public function setCliente(Cliente $cliente) {
        $this->clientes[] = $cliente;
    }

    public function setProducto(Producto $producto) {
        $this->productos[] = $producto;
    }

    public function setAlquilado(Alquilado $alquilado) {
        $this->alquilados[] = $alquilado;
    }

}