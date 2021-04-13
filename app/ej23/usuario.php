<?php

require_once "archivos.php";

class Usuario
{
    public $_nombre;
    public $_clave;
    public $_mail;
    public $_id;
    private DateTime $_fechaRegistro;

    public function __construct($nombre, $clave, $mail, $id = 0)
    {
        $this->_nombre = $nombre;

        $this->_clave = $clave;

        $this->_mail = $mail;

        $this->_id = $id;

        $this->_fechaRegistro = new DateTime('now');
    }

    public function Alta()
    {
        echo (EscribirArchivoJSONobj("usuarios.json", $this) > 0) ?  "Usuarios registrado con exito" :  "No se pudo realizar el alta";
    }

    public static function Listar()
    {
        $dataUsuarios = LeerArchivoJSON("usuarios.json");

        $listaUsuarios = "No se encontraron datos";

        if ($dataUsuarios != []) {

            $listaUsuarios = "<ul>";

            foreach ($dataUsuarios as $usuario) {

                $nuevoUsuario = new Usuario($usuario->_nombre, $usuario->_clave, $usuario->_mail, $usuario->_id);

                $path = "Usuarios/Fotos/".$usuario->_nombre.".png";

                $foto = base64_encode(file_get_contents($path));
                
                $src = 'data:'.mime_content_type($path).';base64,'.$foto; 

                $listaUsuarios .= "<li> {$nuevoUsuario} <br> <img width='250' height='150' src=\"$src\"> </li><br>";
            }

            $listaUsuarios .= "</ul>";
        }

        return $listaUsuarios;
    }

    public function __toString()
    {
        return $this->_nombre . "," . $this->_clave . "," . $this->_mail;
    }
}
