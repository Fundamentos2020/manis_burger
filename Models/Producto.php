<?php 

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
        $this->_idProducto = $idProducto;
    }

    public function setNombre($Nombre) {
        if ($Nombre === null || strlen($Nombre) > 50 || strlen($Nombre) < 1) {
            throw new TareaException("Error en el nombre de producto");
        }
        $this->_Nombre = $Nombre;
    }

    public function setUrlImagen($urlImagen) {
        if ($urlImagen !== null && strlen($urlImagen) > 200) {
            throw new TareaException("Error en la url de la imagen del producto");
        }
        $this->_urlImagen = $urlImagen;
    }

    public function setDescripcion($Descripcion) {
        
        $this->_Descripcion = $Descripcion;
    }

    public function setPrecio($Precio) {
       
        $this->_Precio = $Precio;
    }
    
    public function setDescuento($Descuento) {
       
        $this->_Descuento = $Descuento;
    }

    public function getArray() {
        $producto = array();

        $producto['idProducto'] = $this->getIDProduto();
        $producto['Nombre'] = $this->getNombre();
        $producto['urlImagen'] = $this->getUrlImagen();
        $producto['Descripcion'] = $this->getDescripcion();
        $producto['Precio'] = $this->getPrecio();
        $producto['Descuento'] = $this->getDescuento();

        return $producto;
    }
}

?>