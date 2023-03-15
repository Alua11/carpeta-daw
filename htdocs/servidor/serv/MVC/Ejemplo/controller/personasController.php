<?php
require_once "models/personaModel.php";
//nombre de los controladores suele ir en plural
class PersonasController
{
    private $model;
    public function __construct()
    {
        $this->model = new PersonaModel();
    }
    public function crear(array $arrayPersona): void
    {
        $id = $this->model->insert($arrayPersona);
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
        $persona = $this->model->read($id); //Mi linea
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&evento=borrar&id={$id}";
        // $redireccion .= ($borrado == false) ? "&error=true" : ""; //Linea original
        $redireccion .= ($borrado == false) ? "&error=true" : "&nombre={$persona->nombre}&apellidos={$persona->apellidos}";
        header($redireccion);
    }

    public function editar(int $id, array $arrayPersona): void
    {
        $editadoCorrectamente = $this->model->edit($id, $arrayPersona);
        $redireccion = "location:index.php?accion=editar&evento=guardar&id={$id}";
        $redireccion .= ($editadoCorrectamente == false) ? "&error=true" : "";
        //vuelvo a la pagina donde estaba
        header($redireccion);
    }

    public function buscar(string $campo, string $tipo, string $textoBuscar): array
    {
        return $this->model->search($campo, $tipo, $textoBuscar);
    }

    // campo=usuario, nombre, apellidos...
    //accion= empieza, acaba, contiene, igual 
    //textoBuscar
    // public function buscar(string $campo, string $accion, string $textoBuscar): array
    // {
    //     return $this->model->search($campo, $accion, $textoBuscar);
    // }
}
