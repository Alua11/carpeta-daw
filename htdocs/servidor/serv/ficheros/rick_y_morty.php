<?php

$url = "https://rickandmortyapi.com/api/character?page=";

$i = 1;
$fin = false;

$personajes = [];
while (!$fin) {

    $cadenaJson = file_get_contents($url.$i);
    $arrayRickMorty = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);
    $personajes = array_merge($personajes, $arrayRickMorty["results"]);
    if ($arrayRickMorty["info"]["next"] == "null" || $arrayRickMorty["info"]["next"] == null) $fin = true;
    $i++;

}


echo "<pre>";
var_dump($personajes);
echo "</pre>";

$file = fopen("personajesRickAndMorty.json", "w");
fwrite($file, json_encode($personajes,JSON_OBJECT_AS_ARRAY));
fclose($file);