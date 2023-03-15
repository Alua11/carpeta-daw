<?php
class Cliente {
    private $id;
    private $dni;
    private $nombre;
    private $apellido1;
    private $apellido2;

    // public function __construct(string $n, string $a='20', string $d='20', string $t='vacuna', string $lvl='1') {
    public function __construct()
    {
        // $this->id = $n;
        // $this->dni = $a;
        // $this->nombre = $d;
        // $this->apellido1 = $t;
        // $this->apellido2 = $lvl;
    }
    public function __toString() {
        $cadena = "ID:{$this->id}##";
        $cadena .= "DNI:{$this->dni}##";
        $cadena .= "Nombre:{$this->nombre}##";
        $cadena .= "Apellido1:{$this->apellido1}##";
        $cadena .= "Apellido2:{$this->apellido2}";
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