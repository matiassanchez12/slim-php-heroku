<?php

// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder hacer el alta,
// guardando los datos en usuarios.csv.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario

require "usuario.php";

switch ($_POST["tipo"]) {
    case 'listar':

        $listado = Usuario::Listar();    

        if($listado != ""){

            echo $listado;
        }
        break;
    case 'alta':
        try{
            
            if (isset($_POST["usuario"]) && isset($_POST["contrasenia"]) && isset($_POST["email"])) {
            
                $usuario = new Usuario($_POST["usuario"], $_POST["contrasenia"], $_POST["email"]);
                
                $usuario->Alta();
            }
        }catch(Exception $e){
            
            echo $e->getMessage();
        }
        break;
    default:
        echo "";
        break;
}

