<?php
class Jugador
{
    private $codigo_jugador;
    private $nombre;
    private $posicion;
    private $codigo_equipo;
    private $valor;

    public function __construct(array $datos)
    {
        $this->codigo_jugador = $datos['codigo_jugador'];
        $this->nombre = $datos['nombre'];
        $this->posicion = $datos['posicion'];
        $this->codigo_equipo = $datos['codigo_equipo']??NULL;
        $this->valor = $datos['valor'];
    }
    public function __toString()
    {
        $cadena = "codigo_jugador:{$this->codigo_jugador}##";
        $cadena .= "nombre:{$this->nombre}##";
        $cadena .= "posicion:{$this->posicion}##";
        if ($this->codigo_equipo != NULL) {
            $cadena .= "codigo_equipo:{$this->codigo_equipo}##";
        } else {
            $cadena .= "Sin equipo##";
        }
        $cadena .= "valor:{$this->valor}##";
        return $cadena;
    }

    public function setCodigo_jugador($codigo_jugador)
    {
        $this->codigo_jugador = $codigo_jugador;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    }
    public function setCodigo_equipo($codigo_equipo)
    {
        $this->codigo_equipo = $codigo_equipo;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getCodigo_jugador(): int
    {
        return $this->codigo_jugador;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getPosicion(): string
    {
        return $this->posicion;
    }
    public function getCodigo_equipo(): ?string
    {
        return $this->codigo_equipo;
    }
    public function getValor(): int
    {
        return $this->valor;
    }
}
