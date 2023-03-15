<?php

class Arma {
    private $nombre;
    private $tipo;
    private $danyo;

    public function __construct(string $n, string $t, int $d) {
        $this->nombre = $n;
        $this->tipo = $t;
        $this->danyo = $d;
    }

    public function __toString() {
        return "\t\t\tArma:\n\t\t\t\tNombre: {$this->nombre}\n\t\t\t\tTipo: {$this->tipo}\n\t\t\t\tDaño: {$this->danyo}\n";
    }

    public function setNombre(string $n) {
        $this->nombre = $n;
    }
    public function getNombre():string {
        return $this->nombre;
    }
    public function setTipo(string $t) {
        $this->tipo = $t;
    }
    public function getTipo():string {
        return $this->tipo;
    }
    public function setDanyo(string $d) {
        $this->danyo = $d;
    }
    public function getDanyo():string {
        return $this->danyo;
    }
}