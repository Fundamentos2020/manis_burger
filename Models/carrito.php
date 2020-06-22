<?php
    class Carrito{
        private $_nombre;
        private $_imagen;
        private $_cantidad;
        private $_Subtotal;
        private $_idPedido;
        private $_detallePedido;

        public function __construct($nombre, $imagen, $cantidad,$subtotal, $idPedido, $detallePedido) {
           $this->_nombre = $nombre;
           $this->_imagen= $imagen;
           $this->_cantidad=$cantidad;
           $this->_Subtotal= $subtotal;
           $this->_idPedido= $idPedido;
           $this->_detallePedido = $detallePedido;

        }

        public function getNombre()
        {
           return $this->_nombre;
        }

        public function getImagen()
        {
           return $this->_imagen;
        }

        public function getCantidad()
        {
            return $this->_cantidad;

        }

        public function getSubtotal()
        {
            return $this->_Subtotal;
            
        }

        public function getIdpedido()
        {
            return $this->_idPedido;
            
        }

        public function getDetallePedido()
        {
            return $this->_detallePedido;
        }

        public function getArray()
        {
           $producto = array();

           $producto['nombre']= $this->getNombre();
           $producto['imagen']= $this->getImagen();
           $producto['cantidad']= $this->getCantidad();
           $producto['subtotal']= $this->getSubtotal();
           $producto['idPedido']= $this->getIdpedido();
           $producto['idDetallePedido']= $this->getDetallePedido();

           return $producto;
            
        }
        
    }
?>