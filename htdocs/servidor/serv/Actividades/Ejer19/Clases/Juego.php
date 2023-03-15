<?php

class Juego {
    private $titulo;
    private $motor;
    private $personajes;
    
    public function __construct(string $t, string $m, array $ps = []) {
        $this->titulo = $t;
        $this->motor = $m;
        $this->personajes = $ps;
    }

    public function __clone() {
        foreach ($this->personajes as $indice => $personaje) {
            $this->personajes[$indice]= clone $personaje;
        }
    }

    public function __toString() {
        $cadena = "<pre>\t\t---Juego---\nTitulo: {$this->titulo}\nMotor:  {$this->motor}\nPersonajes:\n";
        
        if (count($this->personajes) == 0) {
            $cadena .= "\tNo hay personajes\n";
        } else {
            foreach ($this->personajes as $personaje) {
                $cadena .= $personaje;
            }
        }
        
        $cadena .= "\t\t---  ---\n</pre><br />";

        return $cadena;
    }


    public function setTitulo(string $t) {
        $this->titulo = $t;
    }
    public function getTitulo():string {
        return $this->titulo;
    }
    public function setMotor(string $m) {
        $this->motor = $m;
    }
    public function getMotor():string {
        return $this->motor;
    }
    public function setPersonajes(array $ps) {
        $this->personajes = $ps;
    }
    public function getPersonajes():array {
        return $this->personajes;
    }

    public function setPersonaje(Personaje $p) {
        $this->personajes[] = $p;
    }


    public function toString() {
        echo "<pre>";
        echo "\t........................................\n";
        echo "\tTitulo: " . $this->titulo . "\n";
        echo "\tMotor: " . $this->motor . "\n";
        $this->personaje->toString();
        echo "\t........................................\n";
        echo "</pre>";
        echo "<br />";
    }
}
