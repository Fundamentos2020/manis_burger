<?php 

class DetalleCombo {
    private $_idDetalleCombo;
    private $_Producto_idProducto;
    private $_idCombo;

    public function __construct($idDetalleCombo, $Producto_idProducto, $idCombo) {
        $this->setIDDetalleCombo($idDetalleCombo);
        $this->setProducto_idProducto($Producto_idProducto);
        $this->_idCombo=$idCombo;
    }

    public function getIDDetallCombo() {
        return $this->_idDetalleCombo;
    }

    public function getProdcuto_idProducto() {
        return $this->_Producto_idProducto;
    }

    public function getIdCombo()
    {
        return $this->_idCombo;
    }
    public function setIDDetalleCombo($idDetalleCombo) {
      
        $this->_idDetalleCombo = $idDetalleCombo;
    }
    
    public function setProducto_idProducto($Producto_idProducto) {
      
        $this->_Producto_idProducto = $Producto_idProducto;
    }

    public function setIdCombo($idcombo)
    {
        $this->_idCombo=$idcombo;
    }

    public function getArray() {
        $DetalleCombo = array();

        $DetalleCombo['idDetalleCombo'] = $this->getIDDetallCombo();
        $DetalleCombo['idProducto'] = $this->getProdcuto_idProducto();
        $DetalleCombo['idCombo']=$this->getIdCombo();
        return $DetalleCombo;
    }
}

?>