<?php 

class DetalleComboException extends Exception {}

class DetalleCombo {
    private $_idDetalleCombo;
    private $_Producto_idProducto;

    public function __construct($idDetalleCombo, $Producto_idProducto) {
        $this->setIDDetalleCombo($idDetalleCombo);
        $this->setProducto_idProducto($Producto_idProducto);
    }

    public function getIDDetallCombo() {
        return $this->_idDetalleCombo;
    }

    public function getProdcuto_idProducto() {
        return $this->_Producto_idProducto;
    }

    public function setIDDetalleCombo($idDetalleCombo) {
        if ($idDetalleCombo !== null && (!is_numeric($idDetalleCombo) || $idDetalleCombo <= 0 || $idDetalleCombo >= 2147483647 || $this->_idDetalleCombo !== null)) {
            throw new DetalleComboException("Error en ID de Detalle del combo");
        }
        $this->_idDetalleCombo = $idDetalleCombo;
    }
    
    public function setProducto_idProducto($Producto_idProducto) {
        if (!is_numeric($Producto_idProducto) || $Producto_idProducto <= 0 || $Producto_idProducto >= 2147483647) {
            throw new DetalleComboException("Error en ID de producto en DetalleCombo");
        }
        $this->_Producto_idProducto = $Producto_idProducto;
    }

    public function getArray() {
        $DetalleCombo = array();

        $DetalleCombo['idDetalleCombo'] = $this->getIDDetallCombo();
        $DetalleCombo['Producto_idProducto'] = $this->getProdcuto_idProducto();

        return $DetalleCombo;
    }
}

?>