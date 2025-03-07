<?php

//Retorno un array vacio o con datos
function CargarTxt($file_name)
{
    $ret = [];

    if(file_exists($file_name) && filesize($file_name) > 0){
        
        $file = fopen($file_name, "r");

        $data = fread($file, filesize($file_name)); 
        
        $ret = explode("\n", $data);

        fclose($file);
    }
    
    return $ret;
}

function GuardarTxt($file_name, $datostxt)
{
    $ret = 0;
    //El archivo no existe, creo uno nuevo
    if(!file_exists($file_name) && filesize($file_name) == 0){

        $file = fopen($file_name, "w");

        $ret = fwrite($file, $datostxt);

        fclose($file);
    }else{ //Ya existe, utilizo la "a" para escribir al final

        $file = fopen($file_name, "a");

        $ret = fwrite($file, "\n".$datostxt);

        fclose($file);
    }
    echo $datostxt;
    //Retorno 1 = Se guardo, 0 = Hubo error
    return $ret;
}
