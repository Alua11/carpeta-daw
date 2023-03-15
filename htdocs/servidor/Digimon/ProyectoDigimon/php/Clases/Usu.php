<?php
class Usu {
    private $nombre;
    private $pass;
    private $digimons;
    private $equipo;
    private $tokenDigievolucion;
    private $pJugadas;
    private $pGanadas;

    public function __construct(string $n, int $p, array $d) {
        $this->nombre = $n;
        $this->pass = $p;
        $this->digimons = $d;
        $this->equipo = $this->digimons;
        $this->tokenDigievolucion = 0;
        $this->pJugadas = 0;
        $this->pGanadas = 0;

        $digimonsSerializado = serializar($this->digimons);
        $equipoSerializado = serializar($this->equipo);
        $partidas = "{$this->tokenDigievolucion}:{$this->pJugadas}:{$this->pGanadas}";

        mkdir('../Usus/' . $this->nombre);

        $fichero = fopen("../Usus/{$this->nombre}/misDigimons.txt", 'w', TRUE);
        fwrite($fichero, $digimonsSerializado);
        fclose($fichero);

        $fichero = fopen("../Usus/{$this->nombre}/miEquipo.txt", 'w', TRUE);
        fwrite($fichero, $equipoSerializado);
        fclose($fichero);

        $fichero = fopen("../Usus/{$this->nombre}/partidas.txt", 'w', TRUE);
        fwrite($fichero, $partidas);
        fclose($fichero);
    }
    public function __toString() {
        $cadena = "Nombre:{$this->nombre}##";
        $cadena .= "Contraseña:{$this->pass}##";
        $cadena .= "Digimons:#";
        foreach($this->digimons as $digimon) {
            $cadena .= $digimon . "#";
        }
        $cadena .= "#Equipo:#";
        foreach ($this->equipo as $digimon) {
            $cadena .= $digimon . "#";
        }
        $cadena .= "#TokenDigievolucion:{$this->tokenDigievolucion}##";
        $cadena .= "PJugadas:{$this->pJugadas}##";
        $cadena .= "PGanadas:{$this->pGanadas}";
        return $cadena;
    }

    public function setNombre($n)
    {
        $this->nombre = $n;
    }
    public function setPass($p)
    {
        $this->pass = $p;
    }
    public function setDigimons($ds)
    {
        $this->digimons = $ds;
    }
    public function setEquipo($e)
    {
        $this->equipo = $e;
    }
    public function setTokenDigievolucion($td)
    {
        $this->tokenDigievolucion = $td;
    }
    public function setPJugadas($pj)
    {
        $this->pJugadas = $pj;
    }
    public function setPGanadas($pg)
    {
        $this->pGanadas = $pg;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getDigimons()
    {
        return $this->digimons;
    }
    public function getEquipo()
    {
        return $this->equipo;
    }
    public function getTokenDigievolucion()
    {
        return $this->tokenDigievolucion;
    }
    public function getPJugadas()
    {
        return $this->pJugadas;
    }
    public function getPGanadas()
    {
        return $this->pGanadas;
    }
}