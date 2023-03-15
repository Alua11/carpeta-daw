<?php
class claseD implements JsonSerializable{
    private $valord;
    public function __construct($d){
        $this->valord=$d;
    }

    public function __toString(){
        return "d vale: ".$this->valord;
    }
    public function jsonSerialize() {
        return get_object_vars($this);//array
    }
}