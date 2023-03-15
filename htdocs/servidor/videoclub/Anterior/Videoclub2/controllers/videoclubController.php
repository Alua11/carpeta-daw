<?php
require_once "models/videoclubModel.php";

class VideoclubController {
    private $model;

    public function __construct()
    {
        $this->model = new VideoclubModel();
    }

    public function guardar(Videoclub $videoclub): void
    {
        echo "controller";
        $borrado = $this->model->save($videoclub);
        $redireccion = "location:index.php";
        // $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    }
}