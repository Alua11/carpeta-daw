<?php
abstract class Producto  {
    private $id;
    private $nombre;
    private $precio;
    private $tipo;
    private $plataforma;
    private $idioma;
    private $duracion;
    private $genero;

    // public function __construct(string $n, string $a='20', string $d='20', string $t='vacuna', string $lvl='1') {
    public function __construct(Array $array)
    {
        $this->id = $array['id'];
        $this->nombre = $array['nombre'];
        $this->precio = $array['precio'];
        $this->tipo = $array['tipo'];
        $this->plataforma = $array['plataforma'];
        $this->idioma = $array['idioma'];
        $this->duracion = $array['duracion'];
        $this->genero = $array['genero'];
    }

    public function __toString() {
        $cadena = "ID:{$this->id}##";
        $cadena .= "DNI:{$this->nombre}##";
        return $cadena;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setNombre($n) {
        $this->nombre = $n;
    }    
    
    public function setPrecio($n) {
        $this->precio = $n;
    }

    public function getID() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }
        
}
