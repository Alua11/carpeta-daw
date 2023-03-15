<?php
require_once "models/clienteModel.php";
require_once "assets/php/funciones.php";
//nombre de los controladores suele ir en plural
class ClientesController
{
    private $model;

    public function __construct()
    {
        $this->model = new ClienteModel();
    }

    public function crear(array $arrayCliente): void
    {
        //controles correspondientes

        //No es necesario controlar id, puesto que es autoincrementable,
        //el usuario no debe introducir nada.

        //campos NO VACIOS, son: dni, nombre y apellido1.
        $arrayNoNulos = ["dni", "nombre", "apellido1"];
        $nulos = HayNulos($arrayNoNulos, $arrayCliente);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
                echo "nulos";
            }
        }

        //Hay que controlar que el dni sea un dni válido.
        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];
        //Esto es un ejemplo, que podria ser otro documento de identificacion y no seguir este patron
        if (!preg_match("/^\d{8}[a-zA-Z]$/", $arrayCliente["dni"])) {
            $error = true;
            $errores["dni"][] = "No es un dni valido";
        }        

        //CAMPOS UNICOS
        $arrayUnicos = ["dni"];
        foreach ($arrayUnicos as $campoUnico) {
            if ($this->model->exist($campoUnico, $arrayCliente[$campoUnico])) {
                $error = true;
                $errores[$campoUnico][] = "El valor {$arrayCliente[$campoUnico]} en {$campoUnico} ya existe";
            }
        }

        //Una vez todos los datos han sido comprobados, se guarda en la base de datos.
        $id = null;
        echo $error;
        if (!$error) $id = $this->model->insert($arrayCliente);
        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayCliente;
            header("location:index.php?accion=crear&tabla=cliente&error=true&id={$id}");
        } else {
            unset($_SESSION["errores"]);
            header("location:index.php?accion=ver&tabla=cliente&id={$id}");
        }
    }
    public function ver(string $id): ?Cliente
    {
        return $this->model->read($id);
    }
    public function listar():Array
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
}
