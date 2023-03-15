<?php
class Digimon {
    private $nombre;
    private $ataque;
    private $defensa;
    private $tipo;
    private $nivel;
    private $digievolucion;

    public function __construct(string $n, string $a='20', string $d='20', string $t='vacuna', string $lvl='1') {
        $this->nombre = $n;
        $this->ataque = $a;
        $this->defensa = $d;
        $this->tipo = $t;
        $this->nivel = $lvl;
        $this->digievolucion = null;

        mkdir('../Digimons/' . $this->nombre);
    }
    public function __toString() {
        $cadena = "Nombre:{$this->nombre}##";
        $cadena .= "Ataque:{$this->ataque}##";
        $cadena .= "Defensa:{$this->defensa}##";
        $cadena .= "Tipo:{$this->tipo}##";
        $cadena .= "Nivel:{$this->nivel}##";
        $cadena .= "Digievolucion:";
        $cadena .= $this->digievolucion != null? $this->digievolucion : "No_digievoluciona";
        return $cadena;
    }

    public function setNombre($n) {
        $this->nombre = $n;
    }
    public function setAtaque($a) {
        $this->ataque = $a;
    }
    public function setDefensa($d) {
        $this->defensa = $d;
    }
    public function setTipo($t) {
        $this->tipo = $t;
    }
    public function setNivel($lvl) {
        $this->nivel = $lvl;
    }
    public function setDigievolucion($de) {
        $this->digievolucion = $de;
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function getAtaque() {
        return $this->ataque;
    }
    public function getDefensa() {
        return $this->defensa;
    }
    public function getTipo() {
        return $this->tipo;
    }
    public function getNivel() {
        return $this->nivel;
    }
    public function getDigievolucion() {
        return $this->digievolucion;
    }
        
}