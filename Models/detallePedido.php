<?php
    class DetallePedido{
        private $_idDetallePedido;
        private $_cantidad;
        private $_subtotal;
        private $_idComboFK;
        private $_idProductoFK;
        private $_idPedido;

        public function __construct($idDetallePedido,
         $cantidad,
         $subtotal,
         $idComboFK,
         $idProductoFK, $idPedido) {
            $this->setIdDetallePedido($idDetallePedido);
            $this->setCantidad($cantidad);
            $this->setSubtotal($subtotal);
            if($idComboFK===null)
            {
                    $this->_idComboFk= "----";
            }
            else{
                $this->setIdComboFK($idComboFK);
            }
            if($idProductoFK===null)
            {
                    $this->_idProducto="----";
            }
            else{
                 $this->setIdProductoFk($idProductoFK);
            }
           
           
            $this->_idPedido= $idPedido;
        }

        public function setidPedido($idPedido)
        {
            $this->_idPedido=$idPedido;
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
        public function getIdComboFK()
        {
            return $this-> _idComboFK;
        }
        public function getIdProductoFK()
        {
            return $this-> _idProductoFK;
        }
        public function getIdPedido()
        {
           return $this->_idPedido;
        }

        public function getArray()
        {
            $detallepedido[] =array();

            $detallepedido['idDetallePedido']=$this->getIdDetallePedido();
            $detallepedido['cantidad']=$this->getCantidad();
            $detallepedido['subtotal']=$this->GetSubtotal();
            $detallepedido['idComboFK']=$this->getIdComboFK();
            $detallepedido['idProductoFK']=$this->getIdProductoFK();
            $detallepedido['idPedido']= $this->getIdPedido();
            return  $detallepedido;

        }
    }
?>