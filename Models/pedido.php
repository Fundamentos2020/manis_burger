<?php

 class Pedido{

    private $_idPedido;
    private $_fechaPedido;
    private $_fechaEntrega;
    private $_idClienteFK;


    public function __construct( $idPedido,
     $fechaPedido,
     $fechaEntrega,
     $idClienteFK) {
        $this->setIdPedido($idPedido);
        $this->setFechaPedido($fechaPedido);
        if($_fechaEntrega===null)
        {
            $this->_fechaEntrega = 'No se ha entregado';
        }
        else{
             $this->setFechaEntrega($fechaEntrega);
        }
       
        $this->setIdClienteFK($idClienteFK);
        $this->setIdDetallePedidoFK($idDetallePedidoFK)
    }

    public function setIdPedido($idPedido)
    {
        $this->_idPedido=$idPedido;
    }

    public function setFechaPedido($fechaPedido)
    {
        $this->_fechaPedido=$fechaPedido;
    }

    public function setfechaEntrega($fechaEntrega)
    {
        $this->_fechaEntrega=$fechaEntrega;
    }

    public function setIdClienteFK($idClienteFK)
    {
        $this->_idClienteFK=$_idClienteFK;
    }

    public function getIdPedido()
    {
        return $this->_idPedido;
    }

    public function getFechaPedido()
    {
        return $this->_fechaPedido;
    }

    public function getFechaEntrega()
    {
        return $this->_fechaEntrega;
    }

    public function getIdClienteFK()
    {
        return $this->_idClienteFK;
    }


    public function getArray()
    {
        $pedido[]= array();

        $pedido['idPedido']=$this->getIdPedido();
        $pedido['fechaPedido']=$this->getFechaPedido();
        $pedido['fechaEntrega']=$this->getFechaEntrega();
        $pedido['idClienteFK']=$this->getIdClienteFK();

        return $pedido;
    }

 }


?>