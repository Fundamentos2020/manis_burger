<?php
    if(isset($_GET['id'])&&$_GET['id']!="")
    {
        $conexion= mysqli_connect("localhost","root","", "manisburger");
        $qry = "select * from imagen where idImagen=".$_GET['id'];
        $res=mysqli_query($conexion,$qry);
        $imagen = mysqli_fetch_array($res);
        //cambiar el tipo de contenido
        header("Content-Type:".$imagen['tipo']);
        echo $imagen['imagen'];
    }

?>