<?php
class Alquilado {
    private $id;
    private $id_cliente;
    private $id_producto;
    private $fecha_inicio;
    private $fecha_fin;

    public function __construct(Array $array)
    {
        $this->id = $array['id'];
        $this->id_cliente = $array['id_cliente'];
        $this->id_producto = $array['id_producto'];
        (isset($array['fecha_inicio']))?$this->fecha_inicio = $array['fecha_inicio']:null;
        (isset($array['fecha_fin']))?$this->fecha_fin = $array['fecha_fin']:null;
    }

    public function __toString()
    {
        $cadena = "ID:{$this->id}##";
        $cadena .= "id_cliente:{$this->id_cliente}##";
        $cadena .= "id_producto:{$this->id_producto}##";
        $cadena .= "fecha_inicio:{$this->fecha_inicio}##";
        $cadena .= "fecha_fin:{$this->fecha_fin}";
        return $cadena;
    }

    public function getID() {
        return $this->id;
    }
    public function getIdCliente() {
        return $this->id_cliente;
    }
    public function getIdProducto() {
        return $this->id_producto;
    }
    public function getFechaInicio() {
        return $this->fecha_inicio;
    }
    public function getFechaFin() {
        return $this->fecha_fin;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setIdCliente($idCli)
    {
        $this->id_cliente = $idCli;
    }
    public function setIdProducto($idPro)
    {
        $this->id_producto = $idPro;
    }
    public function setFechaInicio($fechaInicio) {
        $this->fecha_inicio = $fechaInicio;
    }
    public function setFechaFin($fechaFin)
    {
        $this->fecha_fin = $fechaFin;
    }

}