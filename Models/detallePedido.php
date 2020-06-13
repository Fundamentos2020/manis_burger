<?php
    class DetallePedido{
        private $_idDetallePedido;
        private $_cantidad;
        private $_subtotal;
        private $_descuento;
        private $_idComboFK;
        private $_idProductoFK;


        public function __construct($idDetallePedido,
         $cantidad,
         $subtotal,
         $descuento,
         $idComboFK,
         $idProductoFK) {
            $this->setIdDetallePedido($idDetallePedido);
            $this->setCantidad($cantidad);
            $this->setSubtotal($subtotal);
            $this->setDescuento($descuento);
            $this->setIdComboFK($idDetallePedido);
            $this->setIdProductoFk($idProductoFK);
        }

        public function setIdDetallePedido($idDetallePedido)
        {
            $this->_idDetallePedido=$idDetallePedido;
        }
        public function setCantidad($cantidad)
        {
            $this-> _cantidad=$cantidad;
        }
        public function setSubtotal($subtotal)
        {
             $this-> _subtotal=$subtotal;
        }
        public function setDescuento($descuento)
        {
            $this-> _descuento=$descuento;
        }
        public function setIdComboFK($idComboFK)
        {
            $this-> _idComboFK=$idComboFK;
        }
        public function setIdProductoFK($idProductoFK)
        {
            $this-> _idProductoFK=$idProductoFK;
        }


        public function getIdDetallePedido()
        {
           return $this->_idDetallePedido;
        }
        public function getCantidad()
        {
            return $this-> _cantidad;
        }
        public function GetSubtotal()
        {
             return $this-> _subtotal;
        }
        public function getDescuento()
        {
            return $this-> _descuento;
        }
        public function getIdComboFK()
        {
            return $this-> _idComboFK;
        }
        public function getIdProductoFK()
        {
            return $this-> _idProductoFK;
        }

        public function getArray()
        {
            $detallepedido[] =array();

            $detallepedido['idDetallePedido']=$this->getIdDetallePedido();
            $detallepedido['cantidad']=$this->getCantidad();
            $detallepedido['subtotal']=$this->GetSubtotal();
            $detallepedido['descuento']=$this->getDescuento();
            $detallepedido['idComboFK']=$this->getIdComboFK();
            $detallepedido['idProductoFK']=$this->getIdProductoFK();

            return  $detallepedido;

        }
    }
?>