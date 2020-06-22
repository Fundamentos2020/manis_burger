const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';

document.getElementById('subir').addEventListener('click', function(e){
    e.preventDefault();
    var dataImg = document.getElementById('img').files[0];
    var reader=new FileReader();
    const nombre = dataImg.name;

    reader.onload=function(e) {
        var data=e.target.result;
        cargar(data, nombre);
    }

    // El evento onerror se ejecuta si ha encontrado un error de lectura
    reader.onerror=function(e) {
        document.getElementById("preview").innerHTML="Error de lectura";
    }
    // indicamos que lea la imagen seleccionado por el usuario de su disco duro
    reader.readAsDataURL(dataImg);
   // console.log(dtaIma);
   
})

function cargar(data, nombre) {
    //console.log(data);
    var liga = api+"imgenController.php?tarea=subir";
    var obJson = JSON.stringify({data : data, nombre: nombre})

    xhttp = new XMLHttpRequest(); 
    xhttp.open("GET",liga, true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(obJson);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById('preview').innerHTML=this.responseText;
        }
    };
    
   
    
}

function cargarSelect() {
    
}