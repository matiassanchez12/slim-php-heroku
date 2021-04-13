<?php
// <!-- Aplicación No 23 (Registro JSON)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
// poder hacer el alta,
// guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
// Usuario/Fotos/.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario. -->
require_once "usuario.php";

if (isset($_POST["nombre"]) && isset($_POST["contrasenia"]) && isset($_POST["mail"])) {
    
    $usuario1 = new Usuario($_POST["nombre"], $_POST["contrasenia"], $_POST["mail"]);

    $usuario1->Alta();

    // Creo imagen
    $destino = "Usuarios/Fotos/".$_POST["nombre"];
    
    $backup = "Usuarios/Fotos/VA/".$_POST["nombre"];
    
    SubirImagen($_FILES["fotousuario"], $destino, $backup);
}else{

    echo "asd";
}