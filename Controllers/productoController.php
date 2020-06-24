<?php
 require('../Models/Producto.php');

    try {
        $connection = $connection = new PDO('mysql:host=localhost;dbname=manisburger;charset=utf8', 'root', '');
        if($_GET['tarea']=== 'insertar')
        {
            $SQL = 'INSERT INTO `producto`( `Nombre`, `urlImagen`, `descripcion`, `precio`, `descuento`) VALUES ("'.$_GET['nombre'].'",'.$_GET['idImagen'].',"'.$_GET['descripcion'].'",'.$_GET['precio'].','.$_GET['descuento'].')';
            $query = $connection->prepare($SQL);
            $query->execute();
            
            $rowCount = $query->rowCount();
            if($rowCount>0)
            {
                echo('se inserto');
            }
            else{
                echo('no se inserto: '.$SQL);
            }
        }
        else
        {
            if($_GET['tarea']==='consultaProductos')
            {
                $SQL = 'SELECT * FROM `producto` ORDER BY producto.idProducto DESC';
                $query = $connection->prepare($SQL);
                $query->execute();
                $productos = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $producto = new Producto($row['idProducto'], $row['Nombre'], $row['urlImagen'],$row['descripcion'],$row['precio'],$row['descuento']);
        
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
               if($_GET['tarea']==='eliminar')
               {
                    $SQL="DELETE FROM `producto` WHERE `idProducto` = ".$_GET['id'];
                    $query = $connection->prepare($SQL);
                    $query->execute();
                    echo('se elimino');
               }
               else{
                   if($_GET['tarea']==='consultaProducto')
                    {
                        $SQL = "SELECT * FROM producto where idProducto=".$_GET['id'];
                        $query = $connection->prepare($SQL);
                        $query->execute();
                        $productos = array();
                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $producto = new Producto($row['idProducto'], $row['Nombre'], $row['urlImagen'],$row['descripcion'],$row['precio'],$row['descuento']);
                
                            $productos[] = $producto->getArray();
                        }
                        if(count($productos)>0)
                        {
                            echo(json_encode($productos[0]));
                        }
                        else{
                            $resp = array();
                            $resp['error']="NO HAY PRODUCTOS";
                            echo(json_encode($resp));
                        }
                    }
                    else{
                        if($_GET['tarea']==='actualizar')
                        {
                            $SQL = 'UPDATE `producto` SET  `Nombre`="'.$_GET['nombre'].'",`urlImagen`='.$_GET['idImagen'].',`descripcion`="'.$_GET['descripcion'].'",`precio`='.$_GET['precio'].',`descuento`='.$_GET['descuento'].' WHERE idProducto='.$_GET['idProducto'];
                            //echo($SQL);
                            $query = $connection->prepare($SQL);
                            $query->execute();
                            
                            $rowCount = $query->rowCount();
                            if($rowCount>0)
                            {
                                echo('Se actualizo el registro');
                            }
                            else{
                                echo('No Se actualizo el registro');
                            }
                        } 
                        else{
                            echo('no entro');
                        }
                        
                    }
                   
               }
           }
        }
    } catch (PDOException $e){
        echo ("error de base de datos");
     }
    

?>