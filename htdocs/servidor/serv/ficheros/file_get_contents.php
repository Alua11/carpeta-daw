<?php

$url = "https://swapi.dev/api/people/?page=";

$i = 1;
$fin = false;

$personajes = [];
while (!$fin) {

    $cadenaJson = file_get_contents($url.$i);
    $arrayStarWar = json_decode($cadenaJson, JSON_OBJECT_AS_ARRAY);
    $personajes = array_merge($personajes, $arrayStarWar["results"]);
    if ($arrayStarWar["next"] == "null" || $arrayStarWar["next"] == null) $fin = true;
    $i++;

}


echo "<pre>";
var_dump($personajes);
echo "</pre>";

$file = fopen("personajes.json", "w");
fwrite($file, json_encode($personajes,JSON_OBJECT_AS_ARRAY));
fclose($file);