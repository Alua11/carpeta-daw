<?php

class Perro {
    private $nombre, $raza, $tamanyo;

	public function __constructor($nombre,$raza,$tamanyo) { 
		$this->nombre = $nombre; 
		$this->raza = $raza; 
		$this->tamanyo = $tamanyo; 
	}

    
	public function getNombre() { 
 		return $this->nombre; 
	} 

	public function getRaza() { 
 		return $this->raza; 
	} 

	public function getTamanyo() { 
 		return $this->tamanyo; 
	} 

	public function setNombre($nombre) {  
		$this->nombre = $nombre; 
	} 

	public function setRaza($raza) {  
		$this->raza = $raza; 
	} 

	public function setTamanyo($tamanyo) {  
		$this->tamanyo = $tamanyo; 
	} 
}