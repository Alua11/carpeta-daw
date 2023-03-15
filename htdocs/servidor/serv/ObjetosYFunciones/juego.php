<?php

	class Juego {
		private $titulo;
		private $motor;
		private $personajes=[];

		public function __construct($t, $m){
			$this->titulo = $t;
			$this->motor = $m;
			$this->personajes= [];
		}
        
        public function __clone (){
            foreach ($this->personajes as $indice=>$personaje){
                $this->personajes[$indice]= clone $this->personajes[$indice];
               // $this->personajes[$indice]= clone $personaje;
            }
        }
		public function setTitulo($t) {
			$this->titulo = $t;
		}

		public function getTitulo() {
			return $this->titulo;
		}

		public function setMotor($m) {
			$this->motor = $m;
		}

		public function getMotor() {
			return $this->motor;
		}
		public function anyadirPersonaje(Personaje $p) {
			$this->personajes[] = $p;
		}
		public function setPersonajes(array $p) {
			$this->personajes = $p;
		}

		public function getPersonajes() {
			return $this->personajes;
		}

		public function toString() {
			echo "<pre>";
			echo "\t........................................\n";
			echo "\tTitulo: ".$this->titulo."\n";
			echo "\tMotor:  ".$this->motor."\n";			
			$this->personaje->toString();
			echo "\t........................................\n";
			echo "</pre>";
			echo "<br />";
		}
	}

	class Personaje {
		private $nombre;
		private $edad;
		private $bebida;

		public function __construct($n, $e, $b){
			$this->nombre = $n;
			$this->edad = $e;
			$this->bebida = $b;
		}
public function setNombre($n) {
			$this->nombre = $n;
		}

		public function getNombre() {
			return $this->nombre;
		}

		public function setEdad($e) {
			$this->edad = $e;
		}

		public function getEdad() {
			return $this->edad;
		}

		public function setBebida($b) {
			$this->bebida = $b;
		}

		public function getBebida() {
			return $this->bebida;
		}

		public function toString() {
			echo "\tPersonaje: \n";
			echo "\t\tNombre: ".$this->getNombre()."\n";
			echo "\t\tEdad:   ".$this->getEdad()."\n";
			echo "\t\tBebida: ".$this->getBebida()."\n";
		}
	}

	echo "@ REALIZAMOS UN CLON DEL JUEGO 'A PELO':<br/><br/>";

	$guybrush1 = new Personaje("Guybrush Threepwood", "unkown", "Grog");
    $guybrush2 = new Personaje("aaaaa Threepwood", "unkown", "Grog");

	$monkey = new Juego("The Secret of Monkey Island", "SCUMM");
    $monkey->anyadirPersonaje($guybrush1);
    $monkey->anyadirPersonaje($guybrush2);
    $monkeyClon= clone ($monkey);
	echo "<pre>";
    var_dump($monkey);
    var_dump($monkeyClon);


    echo "/////////NUEVO//////<BR>";
    $personaje1=$monkey->getPersonajes()[0];
    //$personaje1=$personajes[0];

    $personaje1->setNombre("Pepito Grillo");

    var_dump($monkey);
    var_dump($monkeyClon);
