<?php
class Personas
{
    private $id;
    private $usuario;
    private $password;
    private $nombre;
    private $apellidos;
    private $genero;
    //observa que no está el ID sin embargo en la base de datos SÍ
    public function __construct($otros = 'otro')
    {
        $this->nombre = strtoupper($this->nombre);
        // $this->apellidos = substr($this->apellidos, 0, 5);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getGenero()
    {
        return $this->genero;
    }
    // .Más Código de la clase
}
