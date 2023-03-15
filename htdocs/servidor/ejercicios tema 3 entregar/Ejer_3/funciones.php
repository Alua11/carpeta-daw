<?php

function crearPiramide (int $altura):string{
    $piramide = "<table border='0'>";
    for ($i = 1; $i <= $altura; $i++) {
        $piramide .= "<tr>";
        for ($j = $altura; $j > $i; $j--) {
            $piramide .= "<td></td>";
        }
        for ($j = $i; $j >= 1; $j--) {
            $piramide .= "<td>{$j}</td>";
        }
        for ($j = 2; $j <= $i; $j++) {
            $piramide .= "<td>{$j}</td>";
        }
        $piramide .= "</tr>";
    }
    return $piramide."</table>";
}