
<?php

// Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
// de las letras del Array.
// Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
class Algo
{
    public static function invertirarray($array){
        $auxArray = ([]);

        $j = count($array) - 1;

        for ($i=0; $i < count($array); $i++) { 
            
            $auxArray[$i] = $array[$j];
            
            $j --;
        }
        $palabra = implode($auxArray);
        
        echo $palabra;
    } 
}
?>