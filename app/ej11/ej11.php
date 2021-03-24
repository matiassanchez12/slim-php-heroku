<?php

// Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
// que las calcule invocando la función pow).
    $numero = 0;
    $potencia = 0;

    for ($i=1; $i < 4; $i++) {

        echo "potencias de ", $i, ":";
        for ($j=1; $j < 4; $j++) { 
            echo calcular_potencias($i, $j);
        }
        echo "</br>";
    }

    function calcular_potencias($numero, $potencia){
        return "</br>".pow($numero, $potencia);
    }
?>