<?php

function crearEmpleado (string $seccion, string $nombre, string $apellido, string $horas):Array {
    
    $empleado = [$seccion, $nombre, $apellido, $horas];
    return $empleado;
}
