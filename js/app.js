const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';
sesion();

function sesion() {
    var liga = api+"sesionController.php";
    
    //alert(liga);
    var login = document.getElementById('login');
    var item  = document.getElementById('adminbtn')
    console.log(login);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
       
       try
       {
            let data = JSON.parse(this.responseText);
            console.log(data);
            if(data.administrador =="SI")
            {
                item.innerHTML=`<a href="./admin_Productos.html">Adminstrador</a>`
            }
            login.innerHTML="<span style=\"margin-right:10px;\">"+data.nombre+"</span>"+"<a class=\"button-black\" href=\"#\" onClick=\"cerrarSesion()\">Cerrar Sesión</a>";
       }catch(err)
       {
            console.log('no hay nada')
       }
    }
    };
    
    xhttp.open("GET",liga+"?sesion=abrir", true);
    xhttp.send();
}

function cerrarSesion() {
    var liga = api+"sesionController.php";
    
    //alert(liga);
    var login = document.getElementById('login');
    console.log(login);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       //let data = JSON.parse(this.responseText);
        //console.log(this.responseText);
       // console.log(data);
        window.location.href=dir+"index.html";

    }
    };
    
    xhttp.open("GET",liga+"?sesion=cerrar", true);
    xhttp.send();
}