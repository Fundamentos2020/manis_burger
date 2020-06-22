<?php
 require('../Models/imgen.php');

    try {
        $connection = $connection = new PDO('mysql:host=localhost;dbname=manisburger;charset=utf8', 'root', '');
        if($_GET['tarea']=== 'subir'&&!empty($_FILES['imagen']['tmp_name']))
        {
            $nombre = $_FILES['imagen']['name'];
            $tipo = $_FILES['imagen']['type'];
            $nombreTemporal = $_FILES['imagen']['tmp_name'];
            $tamanio = $_FILES['imagen']['size'];
            
            //recuperar el contenido del archivo
            $fp = fopen($nombreTemporal,"r");
            $contenido = fread($fp,$tamanio);
            fclose($fp);
            
            $contenido = addslashes($contenido);

            $SQL = "insert into imagen (imagen, 
									nombre, 
									tipo) values 
									('$contenido',
									'$nombre',
									'$tipo')";
            $query = $connection->prepare($SQL);
            $query->execute();
        
            $rowCount = $query->rowCount();

            if($rowCount>0)
            {
                echo ('Subido!!!');
                header("Location:http://localhost/manis_burger/admin_Productos.html");
            }
            else{
                echo('No se realizo.');
            }
        }
        else{
            if($_GET['tarea']==='consultaImg')
            {
                $SQL = "SELECT * FROM imagen";
                $query = $connection->prepare($SQL);
                $query->execute();
                $imagenes = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $imagen = new imagen($row['idImagen'],'null', $row['nombre'], $row['tipo']);
        
                    $imagenes[] = $imagen->getArray();
                }
                if(count($imagenes)>0)
                {
                    echo(json_encode($imagenes));
                }
                else{
                    $resp = array();
                    $resp['error']="El usuario no existe o no ha iniciado sesion";
                    echo(json_encode($resp));
                }
            }
            else{
                if($_GET['tarea']==='eliminar')
                {
                        $SQL="DELETE FROM `imagen` WHERE `idImagen` = ".$_GET['id'];
                        $query = $connection->prepare($SQL);
                        $query->execute();
                        $rowCount = $query->rowCount();

                        if($rowCount>0)
                        {
                            echo("se elimino");
                        }
                        else{
                            echo('no se elimino por que esta relacionado con un producto');
                        }
                }
                else{
                    echo("Tarea no encontrada.");
                }
            }
            
        }
        /* if($_GET['tarea']=== 'subir')
        {
            $payload = file_get_contents('php://input');
            $info = json_decode($payload);
            echo($info->nombre);
           /* 
        }*/
    }catch (PDOException $e){
        echo ("error de base de datos");
     }

?>