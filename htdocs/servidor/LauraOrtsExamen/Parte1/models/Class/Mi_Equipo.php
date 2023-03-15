<?php
class Mi_Equipo {
    private $codigo_mi_equipo;
    private $nombre;
    private $creditos_gastados;
    private $nick_socio;
    private $fichajes_hechos;

    public function __construct(array $datos)
    {
        $this->codigo_mi_equipo = $datos['codigo_mi_equipo'];
        $this->nombre = $datos['nombre'];
        $this->creditos_gastados = $datos['creditos_gastados']??0;
        $this->nick_socio = $datos['nick_socio'];
        $this->fichajes_hechos = $datos['fichajes_hechos']??"NO";
    }
    public function __toString() {
        $cadena = "codigo_equipo:{$this->codigo_mi_equipo}##";
        $cadena .= "nombre:{$this->nombre}##";
        $cadena .= "creditos_gastados:{$this->creditos_gastados}##";
        $cadena .= "nick_socio:{$this->nick_socio}##";
        $cadena .= "fichajes_hechos:{$this->fichajes_hechos}##";
        return $cadena;
    }

    public function setCodigo_equipo($nombrecodigo_equipo) {
        $this->codigo_mi_equipo = $nombrecodigo_equipo;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setCreditos_gastados($creditos_gastados) {
        $this->creditos_gastados = $creditos_gastados;
    }
    public function setNick_socio ($nick_socio) {
        $this->nick_socio = $nick_socio;
    }
    public function setFichajes_hechos ($fichajes_hechos) {
        $this->fichajes_hechos = $fichajes_hechos;
    }

    public function getCodigo_equipo() :int
    {
        return $this->codigo_mi_equipo;
    }
    public function getNombre() :string
    {
        return $this->nombre;
    }
    public function getCreditos_gastados() :int
    {
        return $this->creditos_gastados;
    }
    public function getNick_socio() :string
    {
        return $this->nick_socio;
    }
    public function getFichajes_hechos() :string
    {
        return $this->fichajes_hechos;
    }
        
}