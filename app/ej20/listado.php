<?php

require("usuario.php");

if(isset($_GET["listado"])){

    if($_GET["listado"] == "usuarios"){

        echo Usuario::Listar();
    }
}
else{
    echo "error";
}
