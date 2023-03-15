<?php

/*Plantear una clase abstracta Trabajador. Definir como atributo su nombre y sueldo. Declarar un
método abstracto: calcularSueldo. Definir otro método para imprimir el nombre y su sueldo.
Plantear una subclase Empleado. Definir el atributo $horasTrabajadas, $valorHora. Para calcular el
sueldo tener en cuenta que se le paga 3.50 la hora.
Plantear una clase Gerente que herede de la clase Trabajador. Para calcular el sueldo tener en cuenta
que se le abona un 10% de las utilidades de la empresa.*/

abstract class Trabajador {
    protected $nombre;
    protected $sueldo;

    public function __construct(string $nom) {
        $this->nombre = $nom;
    }

    public function setNombre(string $nom) {
        $this->nombre = $nom;
    }
    public function getNombre():string {
        return $this->nombre;
    }
    public function getsueldo(): float {
        return $this->sueldo;
    }

    public abstract function calcularSueldo();

    public function imprimirTrabajador() {
        echo "Nombre: {$this->nombre}<br>Sueldo: {$this->sueldo}<br>";
    }
}

class Empleado extends Trabajador {
    private $horasTrabajadas;
    private $valorHora = 3.5;

    public function __construct(string $nom, int $horas) {
        parent::__construct($nom);
        $this->horasTrabajadas = $horas;
    }

    public function setHorasTrabajadas($horas) {
        $this->horastrabajadas = $horas;
    }
    public function setValorHora($valorHora) {
        $this->sueldo = $valorHora;
    }
    public function getHorasTrabajadas() {
        return $this->horasTrabajadas;
    }
    public function getValorHora() {
        return $this->valorHora;
    }


    public function calcularSueldo() {
        $this->sueldo = $this->horasTrabajadas * $this->valorHora;
    }

}

class Gerente extends Trabajador {

    public function calcularSueldo() {
        $cantidad = random_int(1000, 5000);
        $this->sueldo = $cantidad / 10;
    }

}


$e1 = new Empleado('Joel', 40);
$g1 = new Gerente('Laura');

$e1->calcularSueldo();
$g1->calcularSueldo();

$e1->imprimirTrabajador();
$g1->imprimirTrabajador();


