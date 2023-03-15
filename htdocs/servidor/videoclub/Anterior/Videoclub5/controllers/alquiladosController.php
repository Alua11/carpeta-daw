<?php
require_once "models/alquiladoModel.php";
require_once "assets/php/funciones.php";
//nombre de los controladores suele ir en plural
class AlquiladosController
{
    private $model;

    public function __construct()
    {
        $this->model = new AlquiladoModel();
    }

    public function crear(array $arrayAlquiler): void
    {

        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        //controles correspondientes

        //No es necesario controlar id, puesto que es autoincrementable,
        //el usuario no debe introducir nada.

        //campos NO VACIOS, son: id_cliente, id_producto y fecha_inicio.
        $arrayNoNulos = ["id_cliente", "id_producto"];
        $nulos = HayNulos($arrayNoNulos, $arrayAlquiler);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //Una vez todos los datos han sido comprobados, se guarda en la base de datos.
        $id = null;
        if (!$error) {
            $arrayAlquiler["fecha_inicio"] = date('y-m-d');
            $id = $this->model->insert($arrayAlquiler);
        }
        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayAlquiler;
            header("location:index.php?accion=crear&tabla=alquiler&error=true&id={$id}");
        } else {
            unset($_SESSION["errores"]);
            header("location:index.php?accion=ver&tabla=alquiler&id={$id}");
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
    /* public function borrar(string $id): void
    {
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&tabla=piezas&evento=borrar&id={$id}";
        $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    } */
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

    //metodoBusqueda = contiene, empieza, acaba, igual
    public function buscar(string $campo, string $texto): array
    {
        return $this->model->search($campo, $texto);
    }

    public function devolver(string $id, string $idCliente) {
        $devolver = $this->model->devolver($id);
        $redireccion = "location:index.php?accion=alquileresCliente&tabla=cliente&id={$idCliente}";
        $redireccion .= ($devolver == false) ? "&error=true" : "";
        header($redireccion);
    }

    public function lastId(){
        $array = $this->listar();
        $lastId = 0;
        foreach($array as $producto){
            if($producto->getID() > $lastId){
                $lastId = $producto->getID();
            }
        }

        return $lastId;
    }
}
