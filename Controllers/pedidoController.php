<?php
    require('../Models/carrito.php');
    require('../Models/detallePedido.php');
    require('../Models/Auxiliar.php');
    session_start(); 
  
    if(isset($_SESSION)!=null&&isset($_SESSION['id'])&&$_SESSION['id']!="")
    { 
       
        try {
            $connection = new PDO('mysql:host=localhost;dbname=manisburger;charset=utf8', 'root', '');
            if($_GET['tarea']==='insertar')
            {
                if(isset($_SESSION['idPedido'])==null)
                {
                   
                    $SQL= 'INSERT INTO `pedido`( `fecha-pedido`, `fecha-entrega`, `Usuario_idCliente`) VALUES ("'.$_GET['fechaPedido'].'","'.$_GET['fechaPedido'].'","'.$_SESSION['id'].'")';
                  
                    $query = $connection->prepare($SQL);
                    $query->execute();
                   
                    $rowCount = $query->rowCount();
                    if($rowCount>0)
                    {
                        $id = $connection->lastInsertId();
                        $_SESSION['idPedido']=$id;
                        $subtotal = $_GET['precio'] * $_GET['cantidad'];
                      //  echo("precio: ".$_GET['precio']."cantidad: ".$_GET['cantidad']."fecha: ".$_GET['fechaPedido']);
                  
                        
                        if(isset($_GET['idProducto'])!=null && isset($_GET['idCombo'])==null)
                        {
                            $SQL= 'INSERT INTO `detallepedido`(`Cantidad`, `Subtotal`, `Producto_idProducto`, `idPedido`)
                             VALUES ('.$_GET['cantidad'].','.$subtotal.','.$_GET['idProducto'].','.$id.')';
                        }
                        else{
                            if(isset($_GET['idCombo'])!=null && isset($_GET['idProducto'])==null)
                            {
                               $SQL= 'INSERT INTO `detallepedido`(`Cantidad`, `Subtotal`, `COMBO_idCOMBO`, `idPedido`)
                                VALUES ('.$_GET['cantidad'].','.$subtotal.','.$_GET['idCombo'].','.$id.')';
                            }
                            else{
                                $SQL= 'INSERT INTO `detallepedido`(`Cantidad`, `Subtotal`, `COMBO_idCOMBO`, `Producto_idProducto`, `idPedido`)
                                VALUES ('.$_GET['cantidad'].','.$subtotal.','.$_GET['idCombo'].','.$_GET['idProducto'].','.$id.')';

                            }
                        }
                        $query = $connection->prepare($SQL);
                        $query->execute();
                        $mensaje = array();
                        $mensaje['mensaje']='se agrego el producto';
                        echo(json_encode($mensaje));
                    }
                    else{
                        $mensaje = array();
                        $mensaje['mensaje']='No se agrego el producto';
                        echo(json_encode($mensaje));
                    }
                }
                else{
                    $id =$_SESSION['idPedido'];
                    $subtotal = $_GET['precio']* $_GET['cantidad'];
                   // echo("precio: ".$_GET['precio']."cantidad: ".$_GET['cantidad']."fecha: ".$_GET['fechaPedido']."sesion idpedido:".$_SESSION['idPedido']);
                    if(isset($_GET['idProducto'])!=null && isset($_GET['idCombo'])==null)
                    {
                        $SQL= 'INSERT INTO `detallepedido`(`Cantidad`, `Subtotal`, `Producto_idProducto`, `idPedido`)
                         VALUES ('.$_GET['cantidad'].','.$subtotal.','.$_GET['idProducto'].','.$id.')';
                    }
                    else{
                        if(isset($_GET['idCombo'])!=null && isset($_GET['idProducto'])==null)
                        {
                           $SQL= 'INSERT INTO `detallepedido`(`Cantidad`, `Subtotal`, `COMBO_idCOMBO`, `idPedido`)
                            VALUES ('.$_GET['cantidad'].','.$subtotal.','.$_GET['idCombo'].','.$id.')';
                        }
                        else{
                            $SQL= 'INSERT INTO `detallepedido`(`Cantidad`, `Subtotal`, `COMBO_idCOMBO`, `Producto_idProducto`, `idPedido`)
                            VALUES ('.$_GET['cantidad'].','.$subtotal.','.$_GET['idCombo'].','.$_GET['idProducto'].','.$id.')';

                        }
                    }
                    $query = $connection->prepare($SQL);
                    $query->execute();
                    $rowCount = $query->rowCount();
                    if($rowCount>0)
                    {
                        $mensaje['mensaje']='se agrego el producto';
                        echo(json_encode($mensaje));
                    }
                    else{
                        $mensaje = array();
                        $mensaje['mensaje']='No se agrego el producto';
                        echo(json_encode($mensaje));
                    }
                }
            }
            else{
                if($_GET['tarea'] === 'consultaCarrito')
                {
                    if(isset($_SESSION)!= null && isset($_SESSION['idPedido'])!="")
                    {
                        $SQL = 'SELECT producto.Nombre, producto.urlImagen, detallepedido.idDetallePedido ,detallepedido.Cantidad, detallepedido.Subtotal, detallepedido.idPedido FROM producto INNER JOIN detallepedido ON producto.idProducto = detallepedido.Producto_idProducto WHERE idPedido ='.$_SESSION['idPedido'];
                        $query = $connection->prepare($SQL);
                        $query->execute();
                        $productos = array();
                        
                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $producto = new Carrito($row['Nombre'], $row['urlImagen'], $row['Cantidad'],$row['Subtotal'],$row['idPedido'], $row['idDetallePedido']);
                
                            $productos[] = $producto->getArray();
                        }
                        if(count($productos)>0)
                        {
                            echo(json_encode($productos));
                        }
                        else{
                            $resp = array();
                            $resp['error']="NO HAY PRODUCTOS".$SQL;
                            echo(json_encode($resp));
                        }
                    }
                    else{


                        $resp = array();
                        $resp['error']="No hay nada en el registro";
                        echo(json_encode($resp));
                    }
                }
                else {
                    if ($_GET['tarea']=='eliminaDetalle') {
                        $SQL="DELETE FROM `detallepedido` WHERE `idDetallePedido` = ".$_GET['idDetallePedido'];
                      //  echo($SQL);
                        $query = $connection->prepare($SQL);
                        $query->execute();
                        echo('se elimino');
                    } 
                    else{
                        if ($_GET['tarea']=='consultaDetallePedidos') {
                            $SQL = 'SELECT * FROM detallepedido ';
                            $query = $connection->prepare($SQL);
                            $query->execute();
                            $productos = array();
                            
                            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                $producto = new DetallePedido($row['idDetallePedido'], $row['Cantidad'], $row['Subtotal'],$row['COMBO_idCOMBO'],$row['Producto_idProducto'], $row['idPedido']);
                    
                                $productos[] = $producto->getArray();
                            }
                            if(count($productos)>0)
                            {
                                echo(json_encode($productos));
                            }
                            else{
                                $resp = array();
                                $resp['error']="NO HAY PRODUCTOS";
                                echo(json_encode($resp));
                            }
                        }
                        else{
                            if($_GET['tarea'] == 'borrarIDpedido')
                            {
                                unset($_SESSION['idPedido']);
                            }
                            else{
                                if($_GET['tarea']=='consultaCarrito2')
                                {
                                    if(isset($_SESSION)!= null && isset($_SESSION['idPedido'])!="")
                                    {
                                        $SQL = 'SELECT combo.Nombre,producto.urlImagen, detallepedido.idDetallePedido ,detallepedido.Cantidad, detallepedido.Subtotal, detallepedido.idPedido FROM combo INNER JOIN detallepedido ON combo.idCombo = detallepedido.COMBO_idCOMBO INNER JOIN detallecombo on detallecombo.idCombo = combo.idCombo INNER JOIN producto on producto.idProducto = detallecombo.Producto_idProducto WHERE idPedido ='.$_SESSION['idPedido'];
                                        $query = $connection->prepare($SQL);
                                        $query->execute();
                                        $productos = array();
                                        
                                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            $producto = new Carrito($row['Nombre'], $row['urlImagen'], $row['Cantidad'],$row['Subtotal'],$row['idPedido'], $row['idDetallePedido']);
                                
                                            $productos[] = $producto->getArray();
                                        }
                                        if(count($productos)>0)
                                        {
                                            echo(json_encode($productos));
                                        }
                                        else{
                                            $resp = array();
                                            $resp['error']="NO HAY PRODUCTOS";
                                            echo(json_encode($resp));
                                        }
                                    }
                                }
                                else{
                                    if($_GET['tarea']=='consultaProductosDetC')
                                    {
                                        $SQL='SELECT producto.Nombre, producto.precio, detallepedido.Cantidad, detallepedido.Subtotal FROM producto INNER JOIN detallepedido on producto.idProducto=detallepedido.Producto_idProducto';
                                        $query = $connection->prepare($SQL);
                                        $query->execute();
                                        $productos = array();
                                        
                                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            $producto = new Auxiliar($row['Nombre'], $row['precio'], $row['Cantidad'],$row['Subtotal']);
                                
                                            $productos[] = $producto->getArray();
                                        }

                                        $SQL='SELECT combo.Nombre, combo.Precio, detallepedido.Cantidad, detallepedido.Subtotal FROM combo INNER JOIN detallepedido on combo.idCombo=detallepedido.COMBO_idCOMBO';
                                        $query = $connection->prepare($SQL);
                                        $query->execute();;
                                        
                                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            $producto = new Auxiliar($row['Nombre'], $row['Precio'], $row['Cantidad'],$row['Subtotal']);
                                
                                            $productos[] = $producto->getArray();
                                        }
                                        if(count($productos)>0)
                                        {
                                            echo(json_encode($productos));
                                        }
                                        else{
                                            $resp = array();
                                            $resp['mensaje']="NO HAY PRODUCTOS";
                                            echo(json_encode($resp));
                                        }
                                    }
                                    else{
                                        $resp = array();
                                        $resp['error']="no es tarea";
                                        echo(json_encode($resp)); 
                                    }
                                    
                                }
                                
                            }
                            
                        }
                        
                    }
                }
               
               
            }
        }
        catch (PDOException $e){
            echo ("error de base de datos");
        }
    }
    else{
        $mensaje = array();
        $mensaje['mensaje']='No has iniciado sesion...';
        echo(json_encode($mensaje));
    }

?>