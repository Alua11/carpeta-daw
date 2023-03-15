<?php

function esFecha(string $fecha): bool
{
    $esFecha = FALSE;
    //Se localizan los separadores adecuados en la fecha introducida.
    $pos1 = strpos($fecha, "/") ?: strpos($fecha, "-") ?: strpos($fecha, " de ");
    $pos2 = strpos($fecha, "/", $pos1 + 1) ?: strpos($fecha, "-", $pos1 + 1) ?: strpos($fecha, " de ", $pos1 + 1);

    if (($pos1 && $pos2) && ($fecha[$pos1] == $fecha[$pos2])) {
        //En caso de existir los separadores adecuados, se extraen los dias, meses y anyos.

        $dia = substr($fecha, 0, $pos1);
        //echo $dia."<br>";

        $inicioMes = ($pos1 + ($fecha[$pos1] == " " ? 4 : 1));
        $mes = substr($fecha, $inicioMes, $pos2 - $inicioMes);
        //echo $mes."<br>";

        $inicioAnyo = ($pos2 + ($fecha[$pos2] == " " ? 4 : 1));
        $anyo = substr($fecha, $inicioAnyo);
        //echo $anyo;
        
        $anyo = anyoValido($anyo);
        $mes = mesValido($mes);
        $dia = diaValido($dia,$mes,$anyo);

        $esFecha = $anyo && $mes && $dia;
    }
    return $esFecha;
}


function anyoValido(string $anyo): int
{
    $valido = 0;

    if (is_numeric($anyo)) {
        if ($anyo[0] != '0') {
            $anyo *= 1;
            if (is_int($anyo) && $anyo > 0 && $anyo < 4000) {
                $valido = $anyo;
            }
        } else {
            $anyo *= 1;
            if (is_int($anyo) && $anyo > 0 && $anyo < 10) {
                $valido = $anyo;
            }
        }
        
    }
    return $valido;
}

function mesValido(string $mes): int
{
    $num = 0;
    if (is_numeric($mes) && strlen($mes) <= 2) {
        $mes *= 1;
        if (is_int($mes) && $mes >= 1 && $mes <= 12) {
            $num = $mes;
        }
    } else {
        $mes = strtolower($mes);
        $meses = [
            'enero' => 1, 'febrero' => 2, 'marzo' => 3, 'abril' => 4, 'mayo' => 5, 'junio' => 6,
            'julio' => 7, 'agosto' => 8, 'septiembre' => 9, 'octubre' => 10, 'noviembre' => 11,
            'diciembre' => 12, 'ene' => 1, 'feb' => 2, 'mar' => 3, 'abr' => 4, 'may' => 5, 'jun' => 6,
            'jul' => 7, 'ago' => 8, 'sep' => 9, 'oct' => 10, 'nov' => 11, 'dic' => 12
        ];
        $num = $meses[$mes] ?? 0;
    }

    return $num;
}

function diaValido(string $dia, int $mes, string $anyo): int
{
    $num = 0;

    $febrero = 28;
    if ((esDivisible($anyo, 4) && !esDivisible($anyo, 100)) || (esDivisible($anyo, 100) && esDivisible($anyo, 400))) {
        $febrero = 29;
    }

    $dias = [1 => 31, 2 => $febrero, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31];

    $diaMax = $dias[$mes] ?? 0;

    if (is_numeric($dia) && strlen($dia) <= 2) {
        $dia *= 1;
        if (is_int($dia) && ($dia > 0 && $dia <= $diaMax)) {
            $num = $dia;
        }
    }

    return $num;
}

function esDivisible(int $num, int $div): bool
{
    $divisible = $num % $div == 0 ? TRUE : FALSE;

    return $divisible;
}
