<?php
$ruta=(file_exists("assets/php/funciones.php"))?"":"../../";
require_once $ruta. "assets/php/funciones.php";
require_once $ruta."models/piezasModel.php";

require_once $ruta."controllers/inventariosController.php";


//nombre de los controladores suele ir en plural
class PiezasController
{
    private $model;

    public function __construct()
    {
        $this->model = new PiezasModel();
    }

    public function crear(array $arrayPieza,bool $ajax=false): void
    {
        //controles correspondientes
        //preciovent sea numero y mayor a 0, dos decimales
        $error=false;
        $errores=[];
        $_SESSION["errores"]=[];
        $_SESSION["datos"]=[];
        /*
        if (preg_match("^[0-9]+[.,]?([0-9]{0,2})$",$arrayPieza["preciovent"])==""){   
            $error=true;
            $errores["preciovent"][]=preg_match("^[0-9]+[.,]?([0-9]{0,2})$",$arrayPieza["preciovent"]);
        }*/
        if ($arrayPieza["preciovent"]<0){
            $error=true;
            $errores["preciovent"][]="El precio No puede ser menor a 0";
        }
        //campos NO VACIOS
        $arrayNoNulos =["numpieza","preciovent"];
        $nulos=HayNulos($arrayNoNulos, $arrayPieza);
        if (count ($nulos)>0){
            $error=true;
            for ($i=0;$i<count ($nulos);$i++){
                $errores[$nulos[$i]][]="El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos=["numpieza"];

        foreach($arrayUnicos as $CampoUnico){
            if ($this->model->exists ($CampoUnico,$arrayPieza[$CampoUnico])){
                $errores[$CampoUnico][]="El {$arrayPieza[$CampoUnico]} de {$CampoUnico} ya existe";
                $error=true;
            }
        }
        $id=null;
        if (!$error) $id = $this->model->insert($arrayPieza);
        
        if ($id == null){ 
                $_SESSION["errores"]=$errores;
                $_SESSION["datos"]=$arrayPieza;
                $respuesta["ok"]=false;
                $respuesta["errores"]=$errores;
                $respuesta["datos"]=$arrayPieza;
                if (!$ajax)header("location:index.php?accion=crear&tabla=piezas&error=true&id={$id}");
                else echo json_encode ($respuesta);//ajax;
            }
        else {
                unset ($_SESSION["errores"]);
                unset($_SESSION["datos"]);
                $respuesta["ok"]=true;
                $respuesta["errores"]=[];
                $respuesta["datos"]=$arrayPieza;
                if (!$ajax)header("location:index.php?accion=ver&tabla=piezas&id=" . $id);
                else echo json_encode ($respuesta);//ajax;
            }
    
    }
    public function ver(string $id): ?stdClass
    {
        return $this->model->read($id);
    }

    public function listar(bool $esBorrable=false):array
    {
        $piezas= $this->model->readAll();
        
        if ($esBorrable){
            $inventarioController= new InventariosController();
            for ($i=0;$i<count ($piezas);$i++){
                $piezas[$i]["borrable"]=true;
                if (count ($inventarioController->buscar("numpieza","igual",$piezas[$i]["numpieza"]))>0)
                $piezas[$i]["borrable"]=false;
            }
        }
        return $piezas;
    }

    public function borrar(string $id,bool $ajax=false): void
    {
        $borrado = $this->model->delete($id);
        $redireccion = "location:index.php?accion=listar&tabla=piezas&evento=borrar&id={$id}";
        $respuesta=[];
        $respuesta["ok"]=$borrado;
        if ($borrado==false) $redireccion .=  "&error=true";

        if (!$ajax) header($redireccion);
        else echo json_encode($respuesta);
    }

    public function editar(string $idOriginal, array $arrayPieza,bool $ajax=false): void
    {
        //controles correspondientes
        //preciovent sea numero y mayor a 0, dos decimales
        $error=false;
        $errores=[];
        if (isset($_SESSION["errores"])){
            unset ($_SESSION["errores"]);
            unset($_SESSION["datos"]);
        }
        if ( !filter_var($arrayPieza["preciovent"], FILTER_VALIDATE_INT)){
            $error=true;
            $errores["preciovent"][]="El precio No puede ser menor a 0";
        }            
        
        if ($arrayPieza["preciovent"]<0){
            $error=true;
            $errores["preciovent"][]="El precio No puede ser menor a 0";
        }
        //campos NO VACIOS
        $arrayNoNulos =["numpieza","preciovent"];
        $nulos=HayNulos($arrayNoNulos, $arrayPieza);
        if (count ($nulos)>0){
            $error=true;
            for ($i=0;$i<count ($nulos);$i++){
                $errores[$nulos[$i]][]="El campo {$nulos[$i]} es nulo";
            }
        }

        //CAMPOS UNICOS
        $arrayUnicos=[];
        if ($arrayPieza["numpieza"]!=$idOriginal)$arrayUnicos[]="numpieza";

        
        foreach($arrayUnicos as $CampoUnico){
            if ($this->model->exists ($CampoUnico,$arrayPieza[$CampoUnico])){
                $error=true;
                $errores[$CampoUnico][]="El {$arrayPieza[$CampoUnico]} de {$CampoUnico} ya existe. Por favor no lo utilice, pues puede a problemas con los datos";
            }
        }
        //todo correcto
        $editado=false;
        if (!$error) $editado = $this->model->edit($idOriginal, $arrayPieza);
        
        
        if ($ajax==true){// con AJAX
            $respuesta=[];
            $respuesta["ok"]=true;
            $respuesta["errores"]=[];
            $respuesta["datos"]=[];
            if ($editado == false){ //hay errores
                $respuesta["ok"]=false;
                $respuesta["errores"]=$errores;
                $respuesta["datos"]=$arrayPieza;
            }
            echo json_encode($respuesta);
        }
        else{//NO HAY AJAX
            if ($editado == false){ 
                $_SESSION["errores"]=[];
                $_SESSION["datos"]=[];
                $_SESSION["errores"]=$errores;
                $_SESSION["datos"]=$arrayPieza;
                //$_SESSION["datos"]["idOriginal"]=$idOriginal;
                $redireccion = "location:index.php?accion=editar&tabla=piezas&evento=guardar&id={$idOriginal}&error=true";    
                }
            else {
                unset ($_SESSION["errores"]);
                unset($_SESSION["datos"]);
                //este es el nuevo numpieza
                $id=$arrayPieza["numpieza"];
                $redireccion = "location:index.php?accion=editar&tabla=piezas&evento=guardar&id={$id}";
            }
            header($redireccion);
        }
        //vuelvo a la pagina donde estaba
        
    }

    public function buscar (string $campo="numpieza", string $metodo="contiene", string $texto="",$esBorrable=false):array {
        $piezas= $this->model->search ($campo, $metodo, $texto);
        
        if ($esBorrable){
            $inventarioController= new InventariosController();
            for ($i=0;$i<count ($piezas);$i++){
                $piezas[$i]["borrable"]=true;
                if (count ($inventarioController->buscar("numpieza","igual",$piezas[$i]["numpieza"]))>0)
                $piezas[$i]["borrable"]=false;
            }
        }
        return $piezas;
    }
}
