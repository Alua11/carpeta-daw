<?php
require_once "assets/php/funciones.php";
require_once "models/productoModel.php";
//nombre de los controladores suele ir en plural
class ProductosController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductoModel();
    }

    public function crear(array $arrayPieza): void
    {
        //controles correspondientes
        //preciovent sea numero y mayor a 0, dos decimales
        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        if ($arrayPieza["preciovent"] < 0) {
            $error = true;
            $errores["preciovent"][] = "El precio no puede ser menor a 0";
        }
        //campos NO VACIOS
        $arrayNoNulos = ["numpieza", "preciovent"];
        $nulos = HayNulos($arrayNoNulos, $arrayPieza);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos = ["numpieza"];

        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico, $arrayPieza[$CampoUnico])) {
                $errores[$CampoUnico][] = "El {$arrayPieza[$CampoUnico]} de {$CampoUnico} ya existe";
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayPieza);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayPieza;
            header("location:index.php?accion=crear&tabla=piezas&error=true&id={$id}");
        } else {
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:index.php?accion=ver&tabla=piezas&id=" . $id);
        }
    }
    public function ver(string $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function listar()
    {
        return $this->model->readAll();
    }

    public function borrar(string $id): void
    {
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&tabla=producto&evento=borrar&id={$id}";
        $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    }
    /* public function editar(string $id, array $arrayPieza): void
    {
        $editadoCorrectamente = $this->model->edit($id, $arrayPieza);
        if ($editadoCorrectamente == false) {
            $redireccion = "location:index.php?accion=editar&tabla=piezas&evento=guardar&id={$id}&error=true";
        } else {
            $id = $arrayPieza["numpieza"];
            $redireccion = "location:index.php?accion=editar&tabla=piezas&evento=guardar&id={$id}";
        }
        //vuelvo a la pagina donde estaba
        header($redireccion);
    } */

    public function buscar(string $texto): array
    {
        return $this->model->search($texto);
    }
}
