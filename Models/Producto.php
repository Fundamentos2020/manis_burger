<?php 

class ProductoException extends Exception {}

class Producto {
    private $_idProducto;
    private $_Nombre;
    private $_urlImagen;
    private $_Descripcion;
    private $_Precio;
    private $_Descuento;

    public function __construct($idProducto, $Nombre, $urlImagen, $Descripcion, $Precio, $Descuento) {
        $this->setIDProducto($idProducto);
        $this->setNombre($Nombre);
        $this->setUrlImagen($urlImagen);
        $this->setDescripcion($Descripcion);
        $this->setPrecio($Precio);
        $this->setDescuento($Descuento);
    }

    public function getIDProduto() {
        return $this->_idProducto;
    }

    public function getNombre() {
        return $this->_Nombre;
    }

    public function getUrlImagen() {
        return $this->_urlImagen;
    }

    public function getDescripcion() {
        return $this->_Descripcion;
    }

    public function getPrecio() {
        return $this->_Precio;
    }

    public function getDescuento() {
        return $this->_Descuento;
    }

    public function setIDProducto($idProducto) {
        if ($idProducto !== null && (!is_numeric($idProducto) || $idProducto <= 0 || $idProducto >= 2147483647 || $this->_idProducto !== null)) {
            throw new ProductoException("Error en IDProducto de Producto");
        }
        $this->_idProducto = $idProducto;
    }

    public function setNombre($Nombre) {
        if ($Nombre === null || strlen($Nombre) > 50 || strlen($Nombre) < 1) {
            throw new ProductoException("Error en el nombre de producto");
        }
        $this->_Nombre = $Nombre;
    }

    public function setUrlImagen($urlImagen) {
        if ($urlImagen !== null && strlen($urlImagen) > 200) {
            throw new ProductoException("Error en la url de la imagen del producto");
        }
        $this->_urlImagen = $urlImagen;
    }

    public function setDescripcion($Descripcion) {
        if ($Descripcion !== null && strlen($Descripcion) > 150) {
            throw new ProductoException("Error en la descripcion de producto");
        }
        $this->_Descripcion = $Descripcion;
    }

    public function setPrecio($Precio) {
        if ($Precio !== null || $Precio <= 0) {
            throw new ProductoException("Error en precio de producto");
        }
        $this->_Precio = $Precio;
    }
    
    public function setDescuento($Descuento) {
        if ($Descuento !== null || $Descuento <= 0 ) {
            throw new ProductoException("Error en descuento de producto");
        }
        $this->_Descuento = $Descuento;
    }

    public function getArray() {
        $producto = array();

        $producto['idProducto'] = $this->getIDProduto();
        $producto['Nombre'] = $this->getNombre();
        $producto['urlImagenn'] = $this->getUrlImagen();
        $producto['Descripcion'] = $this->getDescripcion();
        $producto['Precio'] = $this->getPrecio();
        $producto['Descuento'] = $this->getDescuento();

        return $producto;
    }
}

?>