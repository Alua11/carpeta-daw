<?php
require_once "models/vendedorModel.php";
//nombre de los controladores suele ir en plural
class VendedoresController
{
    private $model;

    public function __construct()
    {
        $this->model = new VendedorModel();
    }

    public function crear(array $arrayVendedor): void
    {
        $id = $this->model->insert($arrayVendedor);
        ($id == null) ? header("location:index.php?accion=crear&tabla=vendedor&error=true&id={$id}") : header("location:index.php?accion=ver&tabla=vendedor&id=" . $id);
    }

    public function ver(string $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function listar()
    {
        return $this->model->readAll();
    }
    public function borrar(int $id): void
    {
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&tabla=vendedor&evento=borrar&id={$id}";
        $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    }
    public function editar(array $arrayVendedor): void
    {
        $editadoCorrectamente = $this->model->edit($arrayVendedor);
        if ($editadoCorrectamente == false) {
            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=guardar&id={$arrayVendedor['numvend']}&error=true";
        } else {
            $id = $arrayVendedor["numvend"];
            $redireccion = "location:index.php?accion=ver&tabla=vendedor&id={$arrayVendedor['numvend']}";
        }
        header($redireccion);
    }

    // public function buscar (string $texto):array {
    //     return $this->model->search ($texto);
    // }
}
