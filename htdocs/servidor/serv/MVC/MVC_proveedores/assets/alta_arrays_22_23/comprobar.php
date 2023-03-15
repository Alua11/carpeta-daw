<?php
require_once "funciones.php";


$usuarios=[
    "86772872J"=>[
        "nombre"=>"Rosa", "nick"=>"rosa","password"=>"1234",
        "equipo"=>"Barcelona", "aficiones"=>["sofing","fiesta"],
    ],
    "42527113K"=>[
        "nombre"=>"Ana", "nick"=>"ana","password"=>"1234",
        "equipo"=>"Madrid", "aficiones"=>[],
    ],
    "53550725D"=>[
        "nombre"=>"Luis", "nick"=>"luis","password"=>"1234",
        "equipo"=>"Barcelona", "aficiones"=>["sofing","fiesta"],
    ],
];

if (!isset($_REQUEST["dni"])){
    header("location:formulario.php");
}
//RECOJO LOS DATOS
$dni=$_REQUEST["dni"]; $nick=$_REQUEST["nick"]; $nombre=$_REQUEST["nombre"];
$password=$_REQUEST["password"]; $equipo=$_REQUEST["equipo"]; 
//$aficiones=$_REQUEST["aficiones"]??[];
$aficiones=isset($_REQUEST["aficiones"])?$_REQUEST["aficiones"]:[];
//var_dump($aficiones);
$error=false;
$errores=[];

//COMPROBAR DATOS
// tipo de datos

if (!is_valid_dni($dni)){
    $error=true;
    $errores["dni"][]="El formato de dni es invalido";
}
//otros ejemplos como telefono correo...


//campos NO VACIOS
$arrayNoNulos =["dni","nick","password"];
$nulos=HayNulos($arrayNoNulos);
if (count ($nulos)>0){
    $error=true;
    for ($i=0;$i<count ($nulos);$i++){
        $errores[$nulos[$i]][]="El campo {$nulos[$i]} es nulo";
    }
}
//dni repetido??
if (isset($usuarios[$dni])){
    $error=true;
    $errores["dni"][]="El dni:{$dni} ya se encuentra en la bbdd";
}
//NICK REPETIDO??

foreach($usuarios as $indice=>$usuario){
    if ($usuario['nick']==$nick) {
        $error=true;
        $errores["nick"][]="El nick:{$nick} ya se encuentra en la bbdd";
        break;
    }
}
//$error=(existeValor ($usuarios,'nick',$nick))?true:false;

//$error=($encontrado)?true:false;

if (!$error){
    //DAR DE ALTA
    $usuarios[$dni]=[
        "nombre"=>$nombre, "nick"=>$nick,"password"=>$password,
        "equipo"=>$equipo, "aficiones"=>$aficiones,
        ];
    // echo "<pre>";
    // var_dump($usuarios);
    // echo "</pre>";

    }
else{
    $cadenaArray=json_encode($errores, JSON_OBJECT_AS_ARRAY);
    $datos=["dni"=>$dni,"nombre"=>$nombre, "nick"=>$nick,"password"=>$password,
        "equipo"=>$equipo, "aficiones"=>$aficiones,
    ];
    $cadenaDatos=json_encode($datos, JSON_OBJECT_AS_ARRAY);
    
    header ("location:formulario.php?errores=".$cadenaArray."&datos=".$cadenaDatos);
    // foreach ($errores as $campo => $arrayErrores){
    //     foreach ($arrayErrores as $indice =>$msgError){
    //         echo "<br>{$msgError}" ;
    //     }
    // }
}




?>