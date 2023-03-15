<?php
require_once "models/DigimonModel.php";
//nombre de los controladores suele ir en plural
class DigimonsController
{
    private $model;
    public function __construct()
    {
        $this->model = new DigimonModel();
    }
    public function crear(array $arrayDigimon): void
    {
        $id = $this->model->insert($arrayDigimon);
        ($id == null) ? header("location:index.php?accion=crear&error=true&id={$id}") : header("location:index.php?accion=ver&id=" . $id);
    }

    public function ver(int $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function listar()
    {
        return $this->model->readAll();
    }

    public function listar2()
    {
        return $this->model->readAllversionClass();
    }

    public function borrar(int $id): void
    {
        $digimon = $this->model->read($id); //Mi linea
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&evento=borrar&id={$id}";
        // $redireccion .= ($borrado == false) ? "&error=true" : ""; Funciona
        $redireccion .= ($borrado == false) ? "&error=true" : "&nombre={$digimon->nombre}";

        header($redireccion);
    }

    public function editar(int $id, array $arrayDigimon): void
    {
        $editadoCorrectamente = $this->model->edit($id, $arrayDigimon);
        $redireccion = "location:index.php?accion=editar&evento=guardar&id={$id}";
        $redireccion .= ($editadoCorrectamente == false) ? "&error=true" : "";
        //vuelvo a la pagina donde estaba
        header($redireccion);
    }

    public function buscar(string $campo, string $tipo, string $textoBuscar): array
    {
        return $this->model->search($campo, $tipo, $textoBuscar);
    }
}
