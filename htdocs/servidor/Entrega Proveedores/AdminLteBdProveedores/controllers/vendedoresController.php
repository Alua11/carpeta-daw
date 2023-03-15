<?php
require_once "models/vendedorModel.php";
require_once "assets/php/funciones.php";
class VendedoresController
{
    private $model;

    public function __construct()
    {
        $this->model = new VendedorModel();
    }

    public function crear(array $arrayVendedor): void
    {
        //controles correspondientes
        //numvend sea un numero entero, mayor a 0
        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];
        if (is_numeric($arrayVendedor["numvend"])) {
            $num = $arrayVendedor["numvend"]*1;
            if (!is_int($num) || $num <= 0) {
                $error = true;
                $errores["numvend"][] = "El numero de vendedor debe ser mayor que 0";
            }
        } else {
            $error = true;
            $errores["numvend"][] = "El numero de vendedor debe ser un numero";
        }
        
        //campos NO VACIOS
        $arrayNoNulos = ["numvend"];
        $nulos = HayNulos($arrayNoNulos, $arrayVendedor);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos = ["numvend"];

        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico, $arrayVendedor[$CampoUnico])) {
                $errores[$CampoUnico][] = "El {$arrayVendedor[$CampoUnico]} de {$CampoUnico} ya existe";
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayVendedor);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayVendedor;
            header("location:index.php?accion=crear&tabla=vendedor&error=true&id={$id}");
        } else {
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:index.php?accion=ver&tabla=vendedor&id=" . $id);
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
    public function borrar(int $id): void
    {
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&tabla=vendedor&evento=borrar&id={$id}";
        $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    }
    public function editar(array $arrayVendedor): void
    {
        //numvend sea un numero entero, mayor a 0
        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];
        if (is_numeric($arrayVendedor["numvend"])) {
            $num = $arrayVendedor["numvend"] * 1;
            if (!is_int($num) || $num <= 0) {
                $error = true;
                $errores["numvend"][] = "El numero de vendedor debe ser mayor que 0";
            }
        } else {
            $error = true;
            $errores["numvend"][] = "El numero de vendedor debe ser un numero";
        }

        //campos NO VACIOS
        $arrayNoNulos = ["numvend", "nomvend"];
        $nulos = HayNulos($arrayNoNulos, $arrayVendedor);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        $editadoCorrectamente = false;
        if (!$error) $editadoCorrectamente = $this->model->edit($arrayVendedor);

        if (!$editadoCorrectamente) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayVendedor;
            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=editar&id={$arrayVendedor['numvend']}&error=true";
        } else {
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            $redireccion = "location:index.php?accion=editar&tabla=vendedor&evento=editar&id={$arrayVendedor['numvend']}";
        }
        header($redireccion);
    }

    //     public function buscar(string $texto): array
    //     {
    //         return $this->model->search($texto);
    //     }
}
