<?php
include_once "Clases/Pieza.php";
include_once "base_datos.php";

class Piezas_Model  {

   protected $conexion;

   public function __construct()
   {
      $this->conexion = conectar();
   }
   public function getPieza($id):Pieza {
      $sql = "SELECT NUMPIEZA, NOMPIEZA, PRECIOVENT  FROM PIEZA " .
         "WHERE NUMPIEZA = :numpieza";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute(array(":numpieza"=>$id));
      //OJO CON CLASS EL MODO SE PONE CON EL FETCH MODE
      $stmt->setFetchMode(PDO::FETCH_CLASS,'Pieza');
      $pieza = $stmt->fetch();
      var_dump($pieza);
      
      if ($pieza === false)return null;
      return $pieza; 
   }

   public function getPiezas():array {
      $sql = "SELECT NUMPIEZA, NOMPIEZA, PRECIOVENT  FROM PIEZA ";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute(array());
      //OJO CON CLASS EL MODO SE PONE CON EL FETCH MODE
      $stmt->setFetchMode(PDO::FETCH_CLASS,'Pieza');
      //OBJETOS DE TIPO PIEZAS
      $piezas = $stmt->fetchAll();

      return $piezas;
   }
  
   public function create(Pieza $pieza){
      try{
         if (!$this->EsUnico($pieza->getNUMPIEZA())){
            $sql = "INSERT INTO PIEZA (numpieza, nompieza, preciovent)
               VALUES (:numpieza,:nompieza,:preciovent) ";
            $stmt = $this->conexion->prepare($sql);
            $parametros=[":numpieza"=>$pieza->getNUMPIEZA(),
                     ":nompieza"=>$pieza->getNOMPIEZA(),
                     ":preciovent"=>$pieza->getPRECIOVENT()];
            $stmt->execute($parametros);
            return true;
         }
         else return false;
      }
      catch(PDOException $e){
         echo "Error ".$e->getMessage()."<br />";
         return false;
      }
   }
   public function EsUnico($id){
   $sql = "SELECT NUMPIEZA, NOMPIEZA, PRECIOVENT  FROM PIEZA WHERE NUMPIEZA = :numpieza";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute(array(":numpieza"=>$id));
      //OJO CON CLASS EL MODO SE PONE CON EL FETCH MODE
      if($stmt->rowCount()>0) return true;
      else return false;
   }

 public function filterBy ($campo="NUMPIEZA", $filtro="contiene" ,$texto="%"){
   //DESDE LUEGO HAY SOLUCIONES MÁS ELEGANTES PERO ESTA SE ENTIENDE BIEN
      if($filtro=="contiene") $parametros= [":texto"=> "%".$texto."%" ];
      if($filtro=="empieza") $parametros= [":texto"=> $texto."%" ];
      if($filtro=="acaba") $parametros= [":texto"=> "%".$texto ];
      if($filtro=="igual") $parametros= [":texto"=> $texto ];

      $sql = "SELECT NUMPIEZA, NOMPIEZA, PRECIOVENT  FROM PIEZA " .
         "WHERE $campo LIKE :texto";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute($parametros);
      //OJO CON CLASS EL MODO SE PONE CON EL FETCH MODE
      $stmt->setFetchMode(PDO::FETCH_CLASS,'Pieza');
      $piezas = $stmt->fetchAll();
       return $piezas;
 }

   //EVIDENTEMENTE DEBERÁS RELLENAR ESTO
   public function update($id){;}
   public function delete($id){;}
   public function readAll(){;}
   public function EsEditable($id) {;}
   public function EsBorrable($id) {;}

}
?>