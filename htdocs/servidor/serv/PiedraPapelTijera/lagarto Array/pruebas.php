<?php
    $usuario = "papel";
    $maquina = "tijeras";
    $ganadores=[
    "piedra"=>["tijeras","lagarto"],
        "papel"=>["piedra","spock"],
        "tijeras"=>["papel","lagarto"],
        "lagarto"=>["papel", "spock"],
        "spock"=>["piedra", "tijeras"]
    ];


    $hasganado = false;
    if($usuario == $maquina){
        echo "EMPATE!!";
    }
    else 
        foreach($ganadores[$usuario] as $indice => $valor){
            if($maquina == $valor){
                echo "Has ganado";
            }else{
                echo "HAS PERDIDO";
                
            }

        }
        ?>