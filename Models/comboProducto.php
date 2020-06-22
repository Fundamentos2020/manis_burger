<?php 

class comboProducto {
    private $_idCOMBO;
    private $_Precio;
    private $_Descuento;
    private $_Descripcion;
    private $_Nombre;
    private $_idProducto;
    private $_idImagen;

    public function __construct($idCOMBO,$nombre, $Precio, $Descuento, $Descripcion,$idProducto,$idImagen) {
        $this->setIDCOMBO($idCOMBO);
        $this->setPrecio($Precio);
        $this->setDescuento($Descuento);
        $this->setDescripcion($Descripcion);
        $this->_Nombre = $nombre;
        $this->_idProducto = $idProducto;
        $this->_idImagen = $idImagen;
    }
    
    public function getIDCOMBO() {
        return $this->_idCOMBO;
    }

    public function getNombre() {
        return $this->_Nombre;
    }

    public function getIdProducto() {
        return $this->_idProducto;
    }

    public function getPrecio() {
        return $this->_Precio;
    }

    public function getDescuento() {
        return $this->_Descuento;
    }

    public function getDescripcion() {
        return $this->_Descripcion;
    }

    public function getIdImagen() {
        return $this->_idImagen;
    }

    public function setIDCOMBO($idCOMBO) {
        
        $this->_idCOMBO = $idCOMBO;
    }

    public function setPrecio($Precio) {
        
        $this->_Precio = $Precio;
    }

    public function setDescuento($Descuento) {
        
        $this->_Descuento = $Descuento;
    }

    public function setDescripcion($Descripcion) {
        
        $this->_Descripcion = $Descripcion;
    }

    public function getArray() {
        $COMBO = array();

        $COMBO['idCombo'] = $this->getIDCOMBO();
        $COMBO['Nombre'] = $this->getNombre();
        $COMBO['Precio'] = $this->getPrecio();
        $COMBO['Descuento'] = $this->getDescuento();
        $COMBO['Descripcion'] = $this->getDescripcion();
        $COMBO['idProducto'] = $this->getIdProducto();
        $COMBO['idImagen'] = $this->getIdImagen();
        return $COMBO;
    }
}

?>