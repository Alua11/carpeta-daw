<?php
class claseB implements JsonSerializable{
    private $b;
    private $c;
    public function __construct($b,claseC $c){
        $this->b=$b;
        $this->c=$c;
    }
    public function __clone(){
        $this->c= clone ($this->c);
    }

    public function __toString(){
        return "b vale: ".$this->b." c vale:".$this->c;
    }
    public function jsonSerialize() {
        return get_object_vars($this);//array
    }
}