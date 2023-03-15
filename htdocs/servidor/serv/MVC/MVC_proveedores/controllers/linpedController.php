<?php
require_once "models/linpedModel.php";
require_once "assets/php/funciones.php";

class LinpedController
{
    private $model;

    public function __construct()
    {
        $this->model = new LinpedModel();
    }

    public function buscar(string $texto): array
    {
        return $this->model->search($texto);
    }
    
}