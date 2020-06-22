<?php
    require('../Models/COMBO.php');
    require('../Models/DetalleCombo.php');
    require('../Models/comboProducto.php');

    try{
        $connection = $connection = new PDO('mysql:host=localhost;dbname=manisburger;charset=utf8', 'root', '');

        if($_GET['tarea']=='insertaCombo')
        {
            $SQL='INSERT INTO `combo`(`Nombre`, `Precio`, `Descripcion`, `Descuento`) VALUES ("'.$_GET['nombre'].'",'.$_GET['precio'].',"'.$_GET['descripcion'].'",'.$_GET['descuento'].')';
            $query = $connection->prepare($SQL);
            $query->execute();

            $rowCount = $query->rowCount();
            if($rowCount>0)
            {
                $mensaje = array();
                $mensaje['mensaje']='Se inserto el combo...';
                echo(json_encode($mensaje));
            }
            else{
                $mensaje = array();
                $mensaje['mensaje']='No se inserto el combo... '.$SQL;
                echo(json_encode($mensaje));
            }
        }
        else{
            if($_GET['tarea']==='consultaCombos')
            {
                $SQL = 'SELECT * FROM combo';

                $query = $connection->prepare($SQL);
                $query->execute();
                $combos = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $producto = new COMBO($row['idCombo'], $row['Nombre'], $row['Precio'],$row['Descuento'],$row['Descripcion']);
        
                    $combos[] = $producto->getArray();
                }
                if(count($combos)>0)
                {
                    echo(json_encode($combos));
                }
                else{
                    $resp = array();
                    $resp['error']="NO HAY Combos";
                    echo(json_encode($resp));
                }
            }
            else{
                if($_GET['tarea']=='insertaDC'){
                    $SQL='INSERT INTO `detallecombo`( `Producto_idProducto`, `idCombo`) VALUES ('.$_GET['idP'].','.$_GET['idC'].')';
                    $query = $connection->prepare($SQL);
                    $query->execute();

                    $rowCount = $query->rowCount();
                    if($rowCount>0)
                    {
                        $mensaje = array();
                        $mensaje['mensaje']='Se inserto el combo...';
                        echo(json_encode($mensaje));
                    }
                    else{
                        $mensaje = array();
                        $mensaje['mensaje']='No se inserto el combo... ';
                        echo(json_encode($mensaje));
                    }
                }
                else{
                    if($_GET['tarea']=='consultaDC')
                    {
                        $SQL = 'SELECT * FROM detallecombo';

                        $query = $connection->prepare($SQL);
                        $query->execute();
                        $detCom = array();
                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $producto = new DetalleCombo($row['idDetalleCombo'],$row['Producto_idProducto'], $row['idCombo']);
                
                            $detCom[] = $producto->getArray();
                        }
                        if(count($detCom)>0)
                        {
                            echo(json_encode($detCom));
                        }
                        else{
                            $resp = array();
                            $resp['error']="NO HAY informacion";
                            echo(json_encode($resp));
                        }
                    }
                    else{
                        if($_GET['tarea']=='eliminarCombo')
                        {
                            $SQL='DELETE FROM `combo` WHERE idCombo='.$_GET['idC'];
                            $query = $connection->prepare($SQL);
                            $query->execute();

                            $rowCount = $query->rowCount();
                            if($rowCount>0)
                            {
                                $mensaje = array();
                                $mensaje['mensaje']='Se elimino el combo';
                                echo(json_encode($mensaje));
                            }
                            else{
                                $mensaje = array();
                                $mensaje['mensaje']='No se elimino el combo... ';
                                echo(json_encode($mensaje));
                            }
                        }
                        else{
                            if($_GET['tarea']=='eliminarDC')
                            {
                                $SQL='DELETE FROM `detallecombo` WHERE idDetalleCombo='.$_GET['idDC'];
                                $query = $connection->prepare($SQL);
                                $query->execute();

                                $rowCount = $query->rowCount();
                                if($rowCount>0)
                                {
                                    $mensaje = array();
                                    $mensaje['mensaje']='Se elimino el Producto';
                                    echo(json_encode($mensaje));
                                }
                                else{
                                    $mensaje = array();
                                    $mensaje['mensaje']='No se elimino el Producto... '.$SQL;
                                    echo(json_encode($mensaje));
                                }
                            }
                            else{
                                if($_GET['tarea']=='innerJoinCombo')
                                {
                                    $SQL ='SELECT combo.idCombo, combo.Nombre, combo.Precio, combo.Descripcion, combo.Descuento, detallecombo.Producto_idProducto, producto.urlImagen FROM combo INNER JOIN detallecombo ON combo.idCombo=detallecombo.idCombo INNER JOIN producto ON producto.idProducto = detallecombo.Producto_idProducto';
                                    $query = $connection->prepare($SQL);
                                    $query->execute();
                                    $combos = array();
                                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        $producto = new comboProducto($row['idCombo'], $row['Nombre'], $row['Precio'],$row['Descuento'],$row['Descripcion'],$row['Producto_idProducto'],$row['urlImagen']);
                            
                                        $combos[] = $producto->getArray();
                                    }
                                    if(count($combos)>0)
                                    {
                                        echo(json_encode($combos));
                                    }
                                    else{
                                        $resp = array();
                                        $resp['error']="NO HAY Combos";
                                        echo(json_encode($resp));
                                    }
                                }
                                else {
                                    if($_GET['tarea']=='consultaCombo')
                                    {
                                        $SQL ='SELECT combo.idCombo, combo.Nombre, combo.Precio, combo.Descripcion, combo.Descuento, detallecombo.Producto_idProducto, producto.urlImagen FROM combo INNER JOIN detallecombo ON combo.idCombo=detallecombo.idCombo INNER JOIN producto ON producto.idProducto = detallecombo.Producto_idProducto where combo.idCombo='.$_GET['id'];
                                        $query = $connection->prepare($SQL);
                                        $query->execute();
                                        $combos = array();
                                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                            $producto = new comboProducto($row['idCombo'], $row['Nombre'], $row['Precio'],$row['Descuento'],$row['Descripcion'],$row['Producto_idProducto'],$row['urlImagen']);
                                
                                            $combos[] = $producto->getArray();
                                        }
                                        if(count($combos)>0)
                                        {
                                            echo(json_encode($combos));
                                        }
                                        else{
                                            $resp = array();
                                            $resp['error']="NO HAY Combos";
                                            echo(json_encode($resp));
                                        }
                                    }   
                                }
                            }
                        }

                    }
                }
            }
        }

    }
    catch (PDOException $e){
        $mensaje = array();
        $mensaje['mensaje']='Error en la base de datos...';
        echo(json_encode($mensaje));
    }

?>