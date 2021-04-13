<?php

require_once "archivos.php";

class Producto
{
    public $_codigoBarras;
    public $_nombre;
    public $_tipo;
    public $_stock;
    public $_precio;
    public $_id;

    public function __construct($codBarras, $nombre, $tipo, $stock, $precio, $id = null)
    {
        $this->_codigoBarras = $codBarras;
        $this->_nombre = $nombre;
        $this->_tipo = $tipo;
        $this->_precio = $precio;
        $this->_id = rand(0, 10.000);

        if ($id != null) {

            $this->_id = $id;
        }

        if ($stock > 0 && $stock < 999999) {

            $this->_stock = $stock;
        }
    }

    public function Alta()
    {
        $nuevoArray = $this->FindProductoById($this);
        //Si el producto ya existe en la lista, se aumenta su Stock y se vuelve a cargar la lista actualizada
        if ($nuevoArray  != []) {

            echo (EscribirArchivoJSONarray("productos.json", $nuevoArray) > 0) ? "Stock actualizado" : "Ocurrio un error";
        } else if( $nuevoArray == []) {
            //Si el producto no existe se carga al final en el archivo json
            echo (EscribirArchivoJSONobj("productos.json", $this) > 0) ? "Producto ingresado" : "Ocurrio un error";
        }else{
            echo "No se pudo hacer";
        }
    }

    //Devuelve array de productos con el stock actualizado si el producto existe, array vacio caso contrario
    public function FindProductoById(Producto $auxProducto)
    {
        $arrayProductos = LeerArchivoJSON("productos.json");

        if ($arrayProductos != []) {

            $i = 0;

            foreach ($arrayProductos as $data) {
                $producto = new Producto($data->_codigoBarras, $data->_nombre, $data->_tipo, $data->_stock, $data->_precio, $data->_id);
                
                // var_dump($producto->_id);

                if ($auxProducto->_codigoBarras == $producto->_codigoBarras) {

                    $arrayProductos[$i]->_stock = $arrayProductos[$i]->_stock + $auxProducto->_stock;

                    return $arrayProductos;
                }

                $i += 1;
            }
        }
        return [];
    }
    public function __toString()
    {
        return "$this->_codigoBarras, $this->_nombre, $this->_tipo, $this->_stock, $this->_precio, $this->id";
    }
}
