<?php
// Aplicación No 26 (RealizarVenta)
// Archivo: RealizarVenta.php
// método:POST
// Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
// POST .
// Verificar que el usuario y el producto exista y tenga stock.
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// carga los datos necesarios para guardar la venta en un nuevo renglón.
// Retorna un :
// “venta realizada”Se hizo una venta
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en las clases

require_once "archivos.php";
// require_once "./"

class Ventas
{
    public $_codBarra;
    public $_idUsuario;
    public $_idVenta;
    public $_cantidad;

    public function __construct($codBarra, $idUsuario, $cantidad, $idVenta = null)
    {
        $this->_idVenta = rand(0, 10000);

        if ($codBarra != null && $idUsuario != null && $cantidad != null) {
            $this->_codBarra = $codBarra;
            
            $this->_idUsuario = $idUsuario;

            $this->_cantidad = $cantidad;
        }
    }

    public function Alta()
    {
        echo "asd";
        if ($this->ValidarProducto($this->_codBarra, $this->_cantidad) && $this->ValidarUsuario($this->_idUsuario)) {

            echo (EscribirArchivoJSONobj("venta.json", $this) ? "Venta Realizada" : "No se pudo hacer");
        } else {

            echo "No se encontraron los datos";
        }
    }

    // Valido que el producto exista, true si coincide el cod de barras y tiene stock, sino false
    public function ValidarProducto($codBarras, $cantidad)
    {
        $arrayProductos = LeerArchivoJSON("../ej25/productos.json");
        echo $codBarras;
        if (isset($codBarras) && $arrayProductos != []) {

            foreach ($arrayProductos as $producto) {

                if ($producto->_codigoBarras == $codBarras && $producto->_stock >= $cantidad) {

                    return true;
                }
            }
        }
        return false;
    }

    public function ValidarUsuario($idUsuario)
    {
        $arrayUsuarios = LeerArchivoJSON("../ej23/usuarios.json");
        echo $idUsuario;
        if (isset($idUsuario) && $arrayUsuarios != []) {

            foreach ($arrayUsuarios as $usuario) {

                if ($usuario->_id == $idUsuario) {

                    return true;
                }
            }
        }
        return false;
    }

    public function __toString()
    {
        return "$this->_idVenta, $this->_idUsuario, $this->_codBarra";
    }
}
