<?php

function crearConexion(): ?PDO
{
    $dataBaseParams = require __DIR__ . "/../config/database-params.php";

    try {

        $usuario = $dataBaseParams['user'];
        $password = $dataBaseParams['password'];
        $ipServidor = $dataBaseParams['host'];
        $databaseName = $dataBaseParams['database'];
        $conexión = new PDO("mysql:host=$ipServidor;dbname=$databaseName;charset=utf8", $usuario, $password);

    } catch (PDOException $e) {

        echo "Error en la conexión con la Base de datos " . $e->getMessage() . "<br/>";
        return null;

    }

    return $conexión;
}


