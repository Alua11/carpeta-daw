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
}

class Perro extends Animal
{
    private $raza;
    public function __construct($raza, $nombre)
    {
        parent::__construct($nombre);
        //$this->nombre=$nombre;
        $this->raza = $raza;
    }
}
$perro1 = new Perro("chucho", "Rocky");
$perro1->setAlimentacion("Carnivoro");
var_dump($perro1);
