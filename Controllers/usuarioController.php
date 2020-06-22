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
            echo("Tarea no encontrada. no encontre la tarea");
        }
    } catch (PDOException $e){
       echo ("error de base de datos");
    }
   

?>