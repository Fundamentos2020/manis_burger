<?php
     require_once("../Models/Usuario.php");

    session_start();
     try {
        $connection = $connection = new PDO('mysql:host=localhost;dbname=manisburger;charset=utf8', 'root', '');
       
        if(isset($_SESSION) && isset($_SESSION['id'])&&$_SESSION['id']!=""){
            if($_GET['sesion']=='abrir')
            {
                $id=$_SESSION['id'];
                $SQL='SELECT * FROM `usuario` WHERE `idUsuario`="'.$_SESSION['id'].'"';
                $query = $connection->prepare($SQL);
                $query->execute();
                $usuarios = array();
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $nuevoUsuario = new usuario($row['idUsuario'], $row['Nombre'], $row['Apellidos'], $row['E-mail'], $row['Ciudad'], $row['Direccion'], $row['Administrador'], $row['contraseña']);
        
                    $usuarios[] = $nuevoUsuario->getArray();
                }
                if(count($usuarios)>0)
                {
                    $usuario = $usuarios[0];
                    echo(json_encode($usuario));
                }
                else{
                    $resp = array();
                    $resp['error']="El usuario no existe o no ha iniciado sesion";
                    echo(json_encode($resp));
                }
            }
            else{
                session_destroy();
            }
        }
        else{
            echo('no inicio');
        }
        
     }catch (PDOException $e){
       echo ("error de base de datos");
    }

?>