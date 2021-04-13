<?php

require "archivos.php";

class Usuario
{
    private $usuario;
    private $contrasenia;
    private $email;
    public static $listaUsuarios = [];

    public function __construct(string $nombre, string $apellido, string $email = null)
    {
        if ($nombre == "" || $apellido == "") {
            throw new Exception("Error, llenar todos los campos");
        }
        $this->usuario = $nombre;

        $this->contrasenia = $apellido;

        $this->email = $email;
    }

    public function __toString()
    {
        return "{$this->usuario},{$this->contrasenia},{$this->email}";
    }

    public function Alta()
    {
        echo (GuardarTxt("Usuarios.csv", $this->__toString()) > 0) ? "Se agrego el usuario correctamente al archivo" : "Error al guardar";
    }

    public static function Listar()
    {

        $arrayUsuarios = CargarTxt("Usuarios.csv");

        $listado = $arrayUsuarios;

        $listado = "";

        if ($arrayUsuarios !== []) {

            $listado = "<ul>";

            foreach ($arrayUsuarios as $usuario) {

                $atributos = explode(",", $usuario);

                $usuario = new Usuario($atributos[0], $atributos[1], $atributos[2]);

                $listado .= "<li>" . $usuario . "<li><br>";
            }

            $listado .= "</ul>";

            Usuario::$listaUsuarios = CargarTxt("Usuarios.csv");
        } else {

            $listado = "No hay usuarios registrados";
        }

        return $listado;
    }

    public static function UsuarioExiste(Usuario $auxUsuario)
    {
        $listadoUsuarios = CargarTxt("Usuarios.csv");

        foreach ($listadoUsuarios as $datos) {

            $atributos = explode(",", $datos);

            $nuevoUsuario = new Usuario($atributos[0], $atributos[1], $atributos[2]);

            $ret = Usuario::CompararUsuarios($nuevoUsuario, $auxUsuario);

            if ($ret != "") {

                return $ret;
            }
        }
        return $ret;
    }
    
    public static function CompararUsuarios($auxUsuario1, $auxUsuario2)
    {
        if (isset($auxUsuario1) && isset($auxUsuario2) && is_a($auxUsuario1, "Usuario") && is_a($auxUsuario2, "Usuario")) {

            if (
                $auxUsuario1->usuario == $auxUsuario2->usuario
                && $auxUsuario1->contrasenia == $auxUsuario2->contrasenia
                && $auxUsuario1->email == $auxUsuario2->email
            ) {

                return "Verificado";
            } else if (
                $auxUsuario1->usuario == $auxUsuario2->usuario
                && $auxUsuario1->contrasenia != $auxUsuario2->contrasenia
                && $auxUsuario1->email == $auxUsuario2->email
            ) {

                http_response_code(403);
                return "Error en los datos";
            } else if ($auxUsuario1->email != $auxUsuario2->email) {

                http_response_code(403);
                return "Usuario no registrado";
            }
        }

        http_response_code(400);
        return "Error, no se encontraron datos";
    }
}
