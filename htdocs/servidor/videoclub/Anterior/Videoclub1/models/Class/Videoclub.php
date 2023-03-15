<?php
class Cliente {
    private $clientes;
    private $productos;
    private $alquilados;

    public function __construct()
    {
        
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
        foreach ($this->alquilados as $alquilado) {
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

    public function setClientes(array $clientes) {
        $this->clientes = $clientes;
    }
    public function setProductos(array $productos) {
        $this->productos = $productos;
    }

    public function setCliente(Cliente $cliente) {
        $this->clientes[] = $cliente;
    }
    // public function setProducto(Producto $producto)
    // {
    //     $this->productos[] = $producto;
    // }


}