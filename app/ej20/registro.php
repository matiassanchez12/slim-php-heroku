<?php

// Archivo: Login.php
// método:POST
// Recibe los datos del usuario(clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
// Retorna un :
// “Verificado” si el usuario existe y coincide la clave también.
// “Error en los datos” si esta mal la clave.
// “Usuario no registrado si no coincide el mail“
// Hacer los métodos necesarios en la clase usuario

require "usuario.php";

try {

    if (isset($_POST["usuario"]) && isset($_POST["contrasenia"]) && isset($_POST["email"])) {

        $usuario = new Usuario($_POST["usuario"], $_POST["contrasenia"], $_POST["email"]);

        $usuario->Alta();
    }
} catch (Exception $e) {

    echo $e->getMessage();
}
