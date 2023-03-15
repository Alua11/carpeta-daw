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
        (isset($array['idioma'])) ? $this->idioma = $array['idioma'] : null;
        (isset($array['duracion'])) ? $this->duracion = $array['duracion'] : null;
        (isset($array['plataforma'])) ? $this->plataforma = $array['plataforma'] : null;
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

    public function getGenero() {
        return $this->genero;
    }

    public function getDuracion() {
        if($this->duracion == null) { return '-'; }
        return $this->duracion;
    }

    public function getPlataforma() {
        if($this->plataforma == null) { return '-'; }
        return $this->plataforma;
    }

    public function getTipo() {
        return $this->tipo;
    }    
    
    public function getIdioma() {
        if($this->idioma == null) { return '-'; }
        return $this->idioma;
    }

    public function setGenero($id) {
        $this->genero = $id;
    }

    public function setPlataforma($n) {
        $this->plataforma = $n;
    }    
    
    public function setIdioma($n) {
        $this->idioma = $n;
    }   
    public function setDuracion($n) {
        $this->duracion = $n;
    }
        
}
