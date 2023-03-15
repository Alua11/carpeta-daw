<?php
class Animal
{
    protected $nombre;
    protected $color;
    protected $genero;
    protected $alimentacion;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setAlimentacion($ali)
    {
        $this->alimentacion = $ali;
    }

    public function mostrarDatos() {
        echo "Me llamo {$this->nombre} soy de color {$this->color} y me gusta la alimentacion {$this->alimentacion}";
    }
}

class Perro extends Animal
{
    private $raza;
    public function __construct($raza, $nombre)
    {
        parent::__construct($nombre);
        $this->raza = $raza;
    }
    public function mostrarDatos()
    {
        parent::mostrarDatos();
        echo " Y soy de raza: {$this->raza}";
    }
}
$perro1 = new Perro("aaaa2", "aaaaaa");
$perro1->setAlimentacion("Carnivoro");
$perro1->mostrarDatos();
// var_dump($perro1);
