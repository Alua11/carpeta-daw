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

    public function crear(array $arrayProducto): void
    {
        //controles correspondientes
        //preciovent sea numero y mayor a 0, dos decimales
        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        if ($arrayProducto["preciovent"] < 0) {
            $error = true;
            $errores["preciovent"][] = "El precio no puede ser menor a 0";
        }
        //campos NO VACIOS
        if ($arrayProducto['tipo'] == 'juego') {
            $arrayNoNulos = ["nomproducto", "preciovent", "genero", "plataforma"];
        } elseif ($arrayProducto['tipo'] == 'CD') {
            $arrayNoNulos = ["nomproducto", "preciovent", "genero", "idioma"];
        } else {
            $arrayNoNulos = ["nomproducto", "preciovent", "genero", "duracion"];
        }

        $nulos = HayNulos($arrayNoNulos, $arrayProducto);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos = ["nomproducto"];

        foreach ($arrayUnicos as $CampoUnico) {
            if ($this->model->exists($CampoUnico)) {
                $errores[$CampoUnico][] = "El {$arrayProducto[$CampoUnico]} de {$CampoUnico} ya existe";
            }
        }

        $id = null;
        if (!$error) $id = $this->model->insert($arrayProducto);

        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayProducto;
            header("location:index.php?accion=crear&tabla=producto&error=true&id={$id}");
        } else {
            unset($_SESSION["errores"]);
            unset($_SESSION["datos"]);
            header("location:index.php?accion=ver&tabla=producto&id=" . $id);
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
