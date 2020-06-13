<?php
    class usuario{

        private $_idUsuario;
        private $_nombre;
        private $_apellido;
        private $_email;
        private $_ciudad;
        private $_direccion;
        private $_administrador;
        private $_contraseña;

        public function __construct($idUsuario, $nombre, $apellido,$email,$ciudad,$direccion,$administrador,$contraseña)
        {
            $this->setNombre($nombre);
            $this->setIdUsuario($idUsuario);
            $this->setEmail($email);
            $this->setCiudad($ciudad);
            $this->setDireccion($direccion);
            $this->setAdministrador($administrador);
            $this->setContraseña($contraseña);
            $this->setApellido($apellido);
        }
        
        public function setNombre($nombre)
        {
            $this->_nombre = $nombre;
        }

        public function setApellido($apellido)
        {
            $this->_apellido = $apellido;
        }

        public function setIdUsuario($idUsuario)
        {
            $this->_idUsuario=$idUsuario;
        }

        public function setEmail($email)
        {
            # code...
            $this->_email=$email;
        }

        public function setCiudad($ciudad)
        {
            # code...
            $this->_ciudad=$ciudad;
        }

        public function setDireccion($direccion)
        {
            # code...
            $this->_direccion=$direccion;
        }

        public function setAdministrador($administrador)
        {
            # code...
            $this->_administrador=$administrador;

        }

        public function setContraseña($contraseña)
        {
            # code...
            $this->_contraseña=$contraseña;
        }

        public function getNombre()
        {
            # code...
            return $this->_nombre;
        }

        public function getApellido()
        {
            # code...
            return $this->_apellido;
        }

        public function getIdUsuario()
        {
            return $this->_idUsuario;
        }

        public function getEmail()
        {
            return $this->_email;
        }
        
        public function getCiudad()
        {
            return $this->_ciudad;
        }

        public function getDireccion()
        {
            return $this->_direccion;
        }
        
        public function getAdminstrador()
        {
            return $this->_administrador;
        }

        public function getContraseña()
        {
            return $this->_contraseña;
        }

        public function getArray()
        {
            $usuario[] = array();
            
            $usuario['idUsuario']=$this->getIdUsuario();
            $usuario['nombre']=$this->getNombre();
            $usuario['apellido']=$this->getApellido();
            $usuario['email']=$this->getemail();
            $usuario['ciudad']=$this->getCiudad();
            $usuario['direccion']=$this->getDireccion();
            $usuario['administrador']=$this->getAdminstrador();
            $usuario['contraseña']=$this->getContraseña();

            return $usuario;
            
        }
    }
?>