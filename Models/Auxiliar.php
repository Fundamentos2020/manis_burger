<?php
    class Auxiliar{
        private $_nombre;
        private $_precio;
        private $_cantidad;
        private $_Subtotal;

        public function __construct($nombre, $precio, $cantidad,$subtotal) {
           $this->_nombre = $nombre;
           $this->_precio= $precio;
           $this->_cantidad=$cantidad;
           $this->_Subtotal= $subtotal;

        }

        public function getNombre()
        {
           return $this->_nombre;
        }

        public function getPrecio()
        {
           return $this->_precio;
        }

        public function getCantidad()
        {
            return $this->_cantidad;

        }

        public function getSubtotal()
        {
            return $this->_Subtotal;
            
        }

        public function getArray()
        {
           $producto = array();

           $producto['nombre']= $this->getNombre();
           $producto['precio']= $this->getPrecio();
           $producto['cantidad']= $this->getCantidad();
           $producto['subtotal']= $this->getSubtotal();

           return $producto;
            
        }
        
    }
?>