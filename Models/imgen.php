<?php
    class Imagen
    {
        private $_idImagen;
        private $_contenido;
        private $_tipo;
        private $_nombre;

        public function __construct($idImagen,$contenido,$nombre,$tipo) {
            $this->_idImagen=$idImagen;
            $this->_contenido=$contenido;
            $this->_tipo = $tipo;
            $this->_nombre = $nombre;
        }

        public function setIdImagen($idImagen)
        {
            $this->_idImagen=$idImagen;
        }

        public function setTipo($tipo)
        {
            $this->_tipo=$tipo;
        }
        public function setNombre($nombre)
        {
            $this->_nombre=$nombre;
        }
        public function setContenido($contenido)
        {
            $this->_contenido=$contenido;
        }

        public function getContenido()
        {
            return $this->_contenido;
        }

        public function getIdImagen(){
            return $this->_idImagen;
        }

        public function getTipo()
        {
            return $this->_tipo;
        }

        public function getNombre()
        {
           return $this->_nombre;
        }
        public function getArray()
        {
            $array = array();

            $array['idImagen']=$this->getIdImagen();
            $array['nombre']=$this->getNombre();
            $array['contenido']=$this->getContenido();
            $array['tipo']= $this->getTipo();
            return $array;
        }
    }
    
?>