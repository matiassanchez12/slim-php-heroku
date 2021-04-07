<?php

require "archivos.php";

class Usuario
{
    private $usuario;
    private $contrasenia;
    private $email;

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
}
