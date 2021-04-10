<?php

require "archivos.php";

class Usuario
{
    private $usuario;
    private $contrasenia;
    private $email;
    private static $listaUsuarios = [];

    public function __construct(string $nombre, string $apellido, string $email)
    {
        if($nombre == "" || $apellido == "" || $email == ""){
            throw new Exception("Error, llenar todos los campos");
        }
        $this->usuario = $nombre;

        $this->contrasenia = $apellido;

        $this->email = $email;
    }

    public function __toString()
    {
        return "Nombre: {$this->usuario}, conseña: {$this->contrasenia}, Email: {$this->email}";
    }

    public function Alta(){        
        echo (GuardarUsuarioTxt("Usuarios.csv", $this->__toString()) > 0) ? "Se agrego el usuario correctamente al archivo" : "Error al guardar";
    }

    public static function Listar(){ 

        $arrayUsuarios = CargarUsuarioTxt("Usuarios.csv");
        
        $listado = $arrayUsuarios;

        $listado = "";
        
        if($arrayUsuarios !== []){

            $listado = "<ul>";
            
            foreach ($arrayUsuarios as $usuario) {
                
                $atributos = explode(",", $usuario);

                $usuario = new Usuario($atributos[0], $atributos[1], $atributos[2]);

                $listado .= "<li>".$usuario."<li><br>";
            }

            $listado .= "</ul>";

        }

        return $listado;
    }
}
