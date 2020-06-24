
window.onload=function() {
    var liga = api+"sesionController.php";
    
    //alert(liga);
    var login = document.getElementById('login');
    console.log(login);
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
       
       try
       {
            let data = JSON.parse(this.responseText);
            console.log(data);
            if(data.administrador =="NO")
            {
                 window.location.href=dir+"html/index.html";
            }
           
       }catch(err)
       {
            console.log('no hay nada')
       }
    }
    };
    
    xhttp.open("GET",liga+"?sesion=abrir", true);
    xhttp.send();
}