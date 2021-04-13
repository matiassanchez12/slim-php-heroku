<?php

// Retorno un array de tipo JSON caso de exito, sino un array vacio
function LeerArchivoJSON($filename)
{
    $ret = [];

    if (file_exists($filename) && filesize($filename) > 0) {

        $file = fopen($filename, "r");

        $data = fread($file, filesize($filename));

        $ret = json_decode($data);

        fclose($file);
    }

    return $ret;
}
// Guarda datos en un archivo de tipo json caso de exito y devuelve 1, sino 0
function EscribirArchivoJSONarray($filename, $array)
{
    $ret = 0;

    if (!file_exists($filename) && filesize($filename) == 0 && isset($array)) {

        $file = fopen($filename, "w");

        $ret = fwrite($file, json_encode($array));

        fclose($file);
    }
    return $ret;
}

// Guarda un datos en un archivo de tipo json caso de exito y devuelve 1, sino 0.
function EscribirArchivoJSONobj($filename, $Obj)
{
    $ret = 0;

    //El archivo no existe, entonces se crea uno con el modo "w" de fopen
    if (!file_exists($filename) || filesize($filename) == 0 && isset($Obj)) {

        $file = fopen($filename, "w");

        $array[0] = $Obj;
        // $array = array('nombre' => $Obj[0], 'clave' => $Obj[1], 'mail' => $Obj[2]);

        $ret = fwrite($file, json_encode($array));

        fclose($file);
    } else {

        $file = fopen($filename, "c");

        fseek($file, filesize($filename)-1);

        $ret = fwrite($file, ",\n".json_encode($Obj)."]");

        fclose($file);
    }

    return $ret;
}

function SubirImagen($file, $destino, $backup)
{
    $tipo = explode(".", $file["name"]);

    $destino .= ".png";
    
    $backup .= date("d-m-Y-H-i-s").".".$tipo[1];

    if(file_exists($destino)){

        rename($destino, $backup);
    }
    
    return move_uploaded_file($file["tmp_name"], $destino);
}