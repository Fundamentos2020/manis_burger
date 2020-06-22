const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';

document.getElementById('btn-login').addEventListener('click', function(e) {
    e.preventDefault();

    var correo = document.getElementById('correo').value;
    var pwd = document.getElementById('pwd').value;

    if(correo!=""&&pwd!="")
    {
        var liga = api+"usuarioController.php?tarea=consultaUsuario&correo="+correo+"&pwd="+pwd;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);

             if(data[0].administrador=="SI")
             {
                window.location.href=dir+"admin_Clientes.html";
             }
             else{
                window.location.href=dir+"index.html";
             }
        }
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
    }
    else{
        alert('se necesitan ambos campos')
    }
    
});