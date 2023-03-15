<?php
abstract class Producto  {
    private $id;
    private $nombre;
    private $precio;
    private $tipo;
    private $plataform;
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
    public function setDNI($dni) {
        $this->dni = $dni;
    }
    public function setNombre($n) {
        $this->nombre = $n;
    }
    public function setApellido1($a1) {
        $this->apellido1 = $a1;
    }
    public function setApellido2($a2) {
        $this->apellido2 = $a2;
    }

    public function getID() {
        return $this->id;
    }
    public function getDNI() {
        return $this->dni;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido1() {
        return $this->apellido1;
    }
    public function getApellido2() {
        return $this->apellido2;
    }
        
}
