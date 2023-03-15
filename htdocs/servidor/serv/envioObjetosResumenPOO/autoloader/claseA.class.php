<?php
class claseA implements JsonSerializable{
    private $a;
    private $b;
    public function __construct($a,claseB $b){
        $this->a=$a;
        $this->b=$b;
    }

    public function __clone(){
        $this->b= clone ($this->b);
    }

    public function __toString(){
        return "a vale: ".$this->a." ". $this->b;
    }
    public function jsonSerialize() {
        return get_object_vars($this);//array
    }
}