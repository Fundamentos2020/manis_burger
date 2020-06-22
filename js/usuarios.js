const api ='http://localhost:80/manis_burger/Controllers/';

document.getElementById("btn-reg").addEventListener('click', function(e) {
    e.preventDefault();
    var nombre= document.getElementById("Usuario").value;
    var apellido= document.getElementById("apellidos").value;
    var correo = document.getElementById("Correo").value;
    var direccion = document.getElementById("Dirección").value;
    var ciudad = document.getElementById("ciudad").value;
    var contraseña = document.getElementById("pwd").value;
    var admin = "NO";
    if(nombre!="" && apellido != "" &correo!="" &&direccion!="" && ciudad!=""&&contraseña!="")
    {
        var liga = api+"usuarioController.php?tarea=insertar&nombre="+nombre+"&apellido="+apellido+"&correo="+correo+"&direccion="+direccion+
        "&ciudad="+ciudad+"&pwd="+contraseña+"&administrador="+admin;
        //alert(liga);

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                document.getElementById("formulario").innerHTML = this.responseText;
        }
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
    }
    else{
        alert("Se requieren todos los campos");
    }
});


