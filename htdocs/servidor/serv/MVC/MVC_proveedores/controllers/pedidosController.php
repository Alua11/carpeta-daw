<?php
require_once "models/pedidoModel.php";
require_once "assets/php/funciones.php";
//nombre de los controladores suele ir en plural
class PedidosController
{
    private $model;

    public function __construct()
    {
        $this->model = new PedidoModel();
    }

    public function crear(array $arrayPedido): void
    {
        $error = false;
        $errores = [];
        $_SESSION["errores"] = [];
        $_SESSION["datos"] = [];

        //Comprobar fecha correcta
        //Ya me estoy dejando cosas


        //Campos NO VACIOS
        $arrayNoNulos = ["numpedido", "numvend"];
        $nulos = HayNulos($arrayNoNulos, $arrayPedido);
        if (count($nulos) > 0) {
            $error = true;
            for ($i = 0; $i < count($nulos); $i++) {
                $errores[$nulos[$i]][] = "El campo {$nulos[$i]} es nulo";
            }
        }

        //Campos UNICOS
        $arrayUnicos = ["numpedido"];
        foreach ($arrayUnicos as $campoUnico) {
            if ($this->model->exist($campoUnico, $arrayPedido[$campoUnico])) {
                $errores[$campoUnico][] = "El valor {$arrayPedido[$campoUnico]} en {$campoUnico} ya existe";
            }
        }
        //En un primer momento, el id es null.
        $id = null;
        //Si no hay error, entra al if en en caso de poder insertar la fila, id toma el valor de true.
        if (!$error) $id = $this->model->insert($arrayPedido);
        //en caso de id null, se guardan los datos en la sesion y se redirecciona error true a crear.
        if ($id == null) {
            $_SESSION["errores"] = $errores;
            $_SESSION["datos"] = $arrayPedido;
            header("location:index.php?accion=crear&tabla=pedido&error=true&id={$id}");
        } else {
            //En caso de id no null, se elimina de sission el array de errores y se redirecciona a ver con la tabla y el id correspondiente.
            unset($_SESSION["errores"]);
            header("location:index.php?accion=ver&tabla=pedido&id=" . $id);
        }
        // $id = $this->model->insert($arrayPedido);
        // ($id == null) ? header("location:index.php?accion=crear&tabla=pedido&error=true&id={$id}") : header("location:index.php?accion=ver&tabla=pedido&id=" . $id);
    }
    public function ver(int $id): ?stdClass
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
        $redireccion = "location:index.php?accion=listar&tabla=pedido&evento=borrar&id={$id}";
        $redireccion .= ($borrado == false) ? "&error=true" : "";
        header($redireccion);
    }
    public function editar(int $id, array $arrayPedido): void
    {
        $editadoCorrectamente = $this->model->edit($id, $arrayPedido);
        if ($editadoCorrectamente==false){
            $redireccion = "location:index.php?accion=editar&tabla=pedido&evento=guardar&id={$id}&error=true";    
        }
        else{
            $id=$arrayPedido["numpedido"];
            $redireccion = "location:index.php?accion=editar&tabla=pedido&evento=guardar&id={$id}";
        }
        //vuelvo a la pagina donde estaba
        header($redireccion);
    }

    //metodoBusqueda = contiene, empieza, acaba, igual
    public function buscar (string $campo, string $metodoBusquda, string $texto):array {
        return $this->model->search ($campo, $metodoBusquda, $texto);
    }
}
