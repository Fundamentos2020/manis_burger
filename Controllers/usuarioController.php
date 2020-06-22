<?php

    require_once("../Models/Usuario.php");
    try {
        $connection = $connection = new PDO('mysql:host=localhost;dbname=manisburger;charset=utf8', 'root', '');

        if($_GET['tarea']==='insertar')
        {
            $nuevoUsuario = new usuario(0,$_GET['nombre'],$_GET['apellido'],$_GET['correo'],$_GET['ciudad'], $_GET['direccion'],$_GET['administrador'],$_GET['pwd']);
    
            $idUsuario = $nuevoUsuario->getIdUsuario();
            $nombre = $nuevoUsuario->getNombre();
            $apellido=$nuevoUsuario->getApellido();
            $email=$nuevoUsuario->getEmail();
            $ciudad=$nuevoUsuario->getCiudad();
            $direccion=$nuevoUsuario->getDireccion();
            $administrador=$nuevoUsuario->getAdminstrador();
            $contraseña=$nuevoUsuario->getContraseña();
            
        
            $SQL = 'INSERT INTO `usuario`(`Nombre`, `Apellidos`, `E-mail`, `Ciudad`, `Direccion`, `Administrador`, `contraseña`) 
            VALUES ("'.$nombre.'","'.$apellido.'","'.$email.'","'.$ciudad.'","'.$direccion.'","'.$administrador.'","'.$contraseña.'")';
            
            $query = $connection->prepare($SQL);
            $query->execute();
        
            $rowCount = $query->rowCount();
            if ($rowCount === 0) {
                echo ('Error');
            }
            else{
                echo ('<span style="">Usted se ha registrado correctamente. Inicie sesion para entrar. </span>');
            }
        }
        else{
            if($_GET['tarea']==='consultaUsuario')
            {
                    $SQL='SELECT * FROM `usuario` WHERE `E-mail`="'.$_GET['correo'].'" AND contraseña = "'.$_GET['pwd'].'"';
                    $query = $connection->prepare($SQL);
                    $query->execute();
                    $usuarios = array();
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $nuevoUsuario = new usuario($row['idUsuario'], $row['Nombre'], $row['Apellidos'], $row['E-mail'], $row['Ciudad'], $row['Direccion'], $row['Administrador'], $row['contraseña']);
            
                        $usuarios[] = $nuevoUsuario->getArray();
                    }
                    session_start();
                    if(count($usuarios)>0)
                    {
                        $usuario = $usuarios[0];
                        $_SESSION['id']=$usuario['idUsuario'];
                        echo(json_encode($usuarios));
                    }
                    else{
                        $resp = array();
                        $resp['error']="Correo o contraseña invalida. Si no esta registrado registrese";
                        echo(json_encode($resp));
                    }
                   
            }
            else{
                if($_GET['tarea']==='consultaUsuarios')
                {
                    $SQL = "SELECT * FROM usuario";
                    $query = $connection->prepare($SQL);
                    $query->execute();
                    $usuarios = array();
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $nuevoUsuario = new usuario($row['idUsuario'], $row['Nombre'], $row['Apellidos'], $row['E-mail'], $row['Ciudad'], $row['Direccion'], $row['Administrador'], $row['contraseña']);
            
                        $usuarios[] = $nuevoUsuario->getArray();
                    }
                    if(count($usuarios)>0)
                    {
                        echo(json_encode($usuarios));
                    }
                    else{
                        $resp = array();
                        $resp['error']="Correo o contraseña invalida. Si no esta registrado registrese";
                        echo(json_encode($resp));
                    }
                }
                else{
                    if($_GET['tarea']==='eliminar')
                    {
                            $SQL="DELETE FROM `usuario` WHERE `idUsuario` = ".$_GET['id'];
                            $query = $connection->prepare($SQL);
                            $query->execute();
                            echo('se elimino');
                    }
                    else{
                        echo("Tarea no encontrada.");
                    }
                     
                }
               
            }
            
        }
    } catch (PDOException $e){
       echo ("error de base de datos");
    }
   

?>