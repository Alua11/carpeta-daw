<?php
class b{
    private $valor_b;
    public function __construct($b){
        $this->valor_b=$b;
    }
    

	function getValorb() { 
        return $this->valor_b; 
	} 

	function setValorb($valorb) {  
		$this->valor_b = $valorb; 
	} 
}

class a{
    private $valor_a;
    private $b;
    public function __construct($a){
        $this->valor_a=$a;
    }
	function getB():b { 
        return $this->b; 
    } 
    function setB(b $b) {  
        $this->b = $b; 
    } 
	function getValora() { 
        return $this->valor_a; 
	} 

	function setValora($valor_a) {  
		$this->valor_a = $valor_a; 
	} 
}

$a= new a(5);
$b=new b("soy B");
$a->setB( $b);
echo "<pre>";
echo "A: ";
var_dump($a);
$obj2= clone $a;
$obj2->setValora(22);
$obj2->getB()->setValorb("NUEVO VALOR");
echo "NUEVO OBJETO: ";
var_dump($obj2);
echo "ORIGINAL A:  ";
var_dump($a);
