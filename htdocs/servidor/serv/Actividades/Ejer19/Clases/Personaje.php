<?php

class Personaje  {
    private $nombre;
    private $edad;
    private $bebida;
    private $armas;

    public function __construct(string $n, string $e, string $b, array $as = []){
        $this->nombre = $n;
        $this->edad = $e;
        $this->bebida = $b;
        $this->armas = $as;
    }

    public function __clone() {
        foreach ($this->armas as $indice => $arma) {
            $this->armas[$indice] = clone $arma;
        }
    }

    public function __toString() {
        $cadena = "";
        $cadena .= "\tPersonaje: \n";
        $cadena .= "\t\tNombre: {$this->nombre}\n";
        $cadena .= "\t\tEdad: {$this->edad}\n";
        $cadena .= "\t\tBebida: {$this->bebida}\n";
        $cadena .= "\t\tArmas:\n";
        if (count($this->armas) == 0) {
            $cadena .= "\t\t\tNo hay armas\n";
        } else {
            foreach ($this->armas as $arma) {
                $cadena .= $arma;
            }
        }
        return $cadena;
    }

    public function setNombre(string $n) {
        $this->nombre = $n;
    }
    public function getNombre():string {
        return $this->nombre;
    }
    public function setEdad(string $e) {
        $this->edad = $e;
    }
    public function getEdad():string {
        return $this->edad;
    }
    public function setBebida(string $b) {
        $this->bebida = $b;
    }
    public function getBebida():string {
        return $this->bebida;
    }
    public function setArmas(array $as) {
        $this->armas = $as;
    }
    public function getArmas():array {
        return $this->armas;
    }

    public function setArma(Arma $a) {
        $this->armas[] = $a;
    }

    public function toString() {
        echo "\tPersonaje: \n";
        echo "\t\tNombre: " . $this->getNombre() . "\n";
        echo "\t\tEdad: " . $this->getEdad() . "\n";
        echo "\t\tBebida: " . $this->getBebida() . "\n";
    }
}
