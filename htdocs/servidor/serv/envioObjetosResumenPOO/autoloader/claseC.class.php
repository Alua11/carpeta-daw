<?php
class claseC implements JsonSerializable{
    private $c;
    private $d;
    public function __construct($c, claseD $d){
        $this->c=$c;
        $this->d=$d;
    }
    public function __clone(){
        $this->d= clone ($this->d);
    }

    public function __toString(){
        return "c vale: ".$this->c." d vale:".$this->d;
    }
    public function jsonSerialize() {
        return get_object_vars($this);//array
    }
}