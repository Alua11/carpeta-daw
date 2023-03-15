<?php

class Persona {
    protected $nombre;
    protected $edad;

    public function __construct(string $nom, int $ed) {
        $this->nombre = $nom;
        $this->edad = $ed;
    }

    public function setNombre (string $nom) {
        $this->nombre = $nom;
    }
    public function setEdad (int $ed) {
        $this->edad = $ed;
    }

    public function getNombre () {
        return $this->nombre;
    }
    public function getEdad () {
        return $this->edad;
    }

    public function imprimirDatos() {
        echo "Nombre: {$this->nombre}<br>Edad: {$this->edad}";
    }
    public function saludo () {
        echo "Hola, soy persona.";
    }
}

class Empleado extends Persona {
    private $sueldo;

    public function __construct(string $nom, int $ed, int $su) {
        parent::__construct($nom,$ed);
        $this->sueldo = $su;
    }

    public function setSueldo (int $su) {
        $this->sueldo = $su;
    }
    public function getSueldo () {
        return $this->sueldo;
    }

    public function imprimirDatos () {
        parent::imprimirDatos();
        echo "<br>Sueldo: {$this->sueldo}";
    }
    public function saludo () {
        echo "Hola, soy empleado.";
    }
}

$p1 = new Persona("Laura", 27);
$e1 = new Empleado("Joel", 22, 5000);

$p1->imprimirDatos();
$p1->saludo();

$e1->imprimirDatos();
$e1->saludo();