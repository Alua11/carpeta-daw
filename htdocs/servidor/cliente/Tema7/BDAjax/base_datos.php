<?php
define("HOST","localhost");
define("PASSWORD",""); //Esto dependerá del password claro
define("USUARIO","root");//usamos el root por comodidad, pero es poco seguro
define("BB_DD","ejemplo");//base de datos creada con anterioridad

function conectar(){
$conexion=null;
  try{
	$opciones=  array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );	
	$conexion = new PDO('mysql:host='.HOST.';dbname=' . BB_DD, USUARIO,PASSWORD, $opciones);
  }catch(PDOException $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
  }
  return $conexion;
}
