<?php

require_once __DIR__ . "/connection.php";

/**
 * Obtiene el listado de todos las empresas
 *
 * @param int $empresaId
 * @return array
 */
function findAll(int $page, String $querString = "", int $pageSize = 15) : array
{
    $conexion = crearConexion();

    $offset = $page * $pageSize;

    if ($querString) {

        $sql = "SELECT * FROM Enterprise WHERE name LIKE '%$querString%' LIMIT $offset, $pageSize";

    } else {

        $sql = "SELECT * FROM Enterprise LIMIT $offset, $pageSize";

    }

    $listadoEmpresas = $conexion->query($sql);

    if($listadoEmpresas !== FALSE) {
        return $listadoEmpresas->fetchAll(PDO::FETCH_ASSOC);
    }

    return [];

}

/**
 * Busca una empresa con el $id Correspondiente
 *
 * @param int $id
 * @return array
 */
function findEnterprise(int $id) : array
{
    $conexion = crearConexion();

    $sql = "SELECT * FROM Enterprise WHERE id = $id";
    $enterprise = $conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return ($enterprise) ? $enterprise[0] : array();
}

/**
 * Inserta un empresa en la Base de datos
 *
 * @param array $enterprise [name,nif,address,city,province,country,locale,status]
 * @return array
 */
function insertEnterprise(array $enterprise) : array
{
    $conexion = crearConexion();

    $sql = "INSERT INTO Enterprise (name,nif,address,city,province,country,locale,status)
            VALUES ('{$enterprise['name']}', '{$enterprise['nif']}', '{$enterprise['address']}', 
                    '{$enterprise['city']}', '{$enterprise['province']}', '{$enterprise['country']}',
                    '{$enterprise['locale']}', {$enterprise['status']})";

    $numAffectedRows = $conexion->exec($sql);

    if( $numAffectedRows > 0 ) {

        return findEnterprise($conexion->lastInsertId());

    } else {

        print_r($conexion->errorInfo());
        return [];

    }
}

/**
 * Modifica los datos de una empresa
 *
 * @param array $enterprise [name,nif,address,city,province,country,locale,status]
 * @return bool
 */
function updateEnterprise(array $enterprise) : bool
{
    $conexion = crearConexion();

    $sql = "UPDATE User SET 
                firstName = '{$enterprise['name']}',
                lastName = '{$enterprise['nif']}',
                email = '{$enterprise['address']}',
                phoneNumber = '{$enterprise['city']}',
                locale = '{$enterprise['province']}',
                birthday = '{$enterprise['country']}',
                idEnterprise = {$enterprise['locale']},
                active = {$enterprise['status']}
                WHERE id = {$enterprise['id']} ";

    $numAffectedRows = $conexion->exec($sql);

    if($numAffectedRows !== false ) {

        return true;

    } else {

        print_r($conexion->errorInfo());
        return false;

    }
}

/**
 * Borra una empresa
 *
 * @param int $id
 * @return bool
 */
function deleteEnterprise(int $id) : bool
{
    $conexion = crearConexion();
    $sql = "DELETE FROM Enterprise WHERE id = $id";

    $numAffectedRows = $conexion->exec($sql);

    if ($numAffectedRows !== false) {
        return true;
    } else {
        print_r($conexion->errorInfo());
        return false;
    }
}