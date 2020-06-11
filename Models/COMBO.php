<?php 

class ComboException extends Exception {}

class COMBO {
    private $_idCOMBO;
    private $_Precio;
    private $_Descuento;
    private $_Descripcion;
    private $_DetalleCombo_idDetalleCombo;

    public function __construct($idCOMBO, $Precio, $Descuento, $Descripcion, $DetalleCombo_idDetalleCombo) {
        $this->setIDCOMBO($idCOMBO);
        $this->setPrecio($Precio);
        $this->setDescuento($Descuento);
        $this->setDescripcion($Descripcion);
        $this->setDetalleCombo_idDetalleCombo($DetalleCombo_idDetalleCombo);
    }
    
    public function getIDCOMBO() {
        return $this->_idCOMBO;
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

    public function getDetalleCombo_idDetalleCombo() {
        return $this->_DetalleCombo_idDetalleCombo;
    }

    public function setIDCOMBO($idCOMBO) {
        if ($idCOMBO !== null && (!is_numeric($idCOMBO) || $idCOMBO <= 0 || $idCOMBO >= 2147483647 || $this->_idCOMBO !== null)) {
            throw new ComboException("Error en ID del combo");
        }
        $this->_idCOMBO = $idCOMBO;
    }

    public function setPrecio($Precio) {
        if ($Precio !== null || $Precio <= 0) {
            throw new ComboException("Error en precio del combo");
        }
        $this->_Precio = $Precio;
    }

    public function setDescuento($Descuento) {
        if ($Descuento !== null || $Descuento <= 0 ) {
            throw new ComboException("Error en descuento de combo");
        }
        $this->_Descuento = $Descuento;
    }

    public function setDescripcion($Descripcion) {
        if ($Descripcion !== null && strlen($Descripcion) > 150) {
            throw new ComboException("Error en descripción de combo");
        }
        $this->_descripcion = $Descripcion;
    }
    
    public function setDetalleCombo_idDetalleCombo($DetalleCombo_idDetalleCombo) {
        if (!is_numeric($DetalleCombo_idDetalleCombo) || $DetalleCombo_idDetalleCombo <= 0 || $DetalleCombo_idDetalleCombo >= 2147483647) {
            throw new ComboException("Error en ID de categoria en ");
        }
        $this->_DetalleCombo_idDetalleCombo = $DetalleCombo_idDetalleCombo;
    }

    public function getArray() {
        $COMBO = array();

        $COMBO['idCombo'] = $this->getIDCOMBO();
        $COMBO['Precio'] = $this->getPrecio();
        $COMBO['Descuento'] = $this->getDescuento();
        $COMBO['Descripcion'] = $this->getDescripcion();
        $COMBO['DetalleCombo_idDetalleCombo'] = $this->getDetalleCombo_idDetalleCombo();
        
        return $COMBO;
    }
}

?>