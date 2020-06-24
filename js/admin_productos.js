const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';


cargarImagenesCombo();
tablaProductos();

function cargarImagenesCombo() {
    
    var combo = document.getElementById('imagenes');


    var liga = api+"imgenController.php?tarea=consultaImg";

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            let opciones=""
            let cont=0;
          //  console.log(data);
            data.forEach(function(item){
                opciones+=" <option value="+item.idImagen+">"+item.nombre+"</option>"
                if(cont==0)
                {
                    var linea =  ' <img src="../Controllers/vista.php?id='+item.idImagen+'" style="width: 130px; height: 130px;">'
                    var vista = document.getElementById('vista');
                    vista.innerHTML=linea
                }
                cont=cont+1;
            });
            combo.innerHTML=opciones;
        }
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();

        
}

document.getElementById('agregar').addEventListener('click',function(e){
    e.preventDefault();
    var nombre = document.getElementById('nomProd').value;
    var descripcion = document.getElementById('descripcion').value;
    var idImagen = document.getElementById('imagenes').value;
    var descuento = document.getElementById('descuento').value;
    var precio = document.getElementById('precio').value;

    if(descuento=="")
    {
        descuento=0;
    }
    if(nombre!=""&&descripcion!=""&&idImagen!=""&&descuento!=""&&precio!="")
   { 
       var liga = api+"productoController.php?tarea=insertar&nombre="+nombre+"&descripcion="+descripcion+"&idImagen="+idImagen+
                "&descuento="+descuento+"&precio="+precio;
        console.log(liga)
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) { 
                tablaProductos()
            }
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
    }
    else{
        alert("Se necesitan todos los campos")
    }

})

document.getElementById('imagenes').addEventListener('change',function(e){
    var vista = document.getElementById('vista');
    console.log(this.value)
    var linea =  ' <img src="../Controllers/vista.php?id='+this.value+'" style="width: 130px; height: 130px;">'
    console.log(linea)
    vista.innerHTML=linea
})

function tablaProductos()
{
    var liga = api+"productoController.php?tarea=consultaProductos";
    var lproductos = document.getElementById('lproductos')
    lproductos.innerHTML= '<option value="0">Ninguno</option>';
    var tabla = document.getElementById('t01')
    tabla.innerHTML=" <tr>"+
                   " <th>Nombre</th>"+
                   " <th>Precio</th> "+
                   " <th>Descuento</th> "+
                    "<th>Descripcion</th>"+
                    "<th>Imagen</th>"+
                   " <th>Eliminar</th>"+
                    "</tr>"
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        let data = JSON.parse(this.responseText);
        let renglones=""
        let opciones =""
        //document.getElementById('preview').innerHTML=this.responseText;
       // console.log(data);
        data.forEach(function(item){
            renglones+="<tr>"+
            "<td>"+item.Nombre+"</td>"+
            "<td>"+item.Precio+"</td>"+
            "<td>"+item.Descuento+"</td>"+
            "<td>"+
                "<p>"+item.Descripcion+" </p>" +
            "</td>"+
            "<td>"+
                "<img src=\"../Controllers/vista.php?id="+item.urlImagen+"\" style=\"width: 50px; height: 50px;\">" +
            "</td>"+
            "<td>"+
                "<div class=\"row div-btn2\"><a href=\"#\" class=\"btn btn-eliminar\" onclick=\"eliminarProducto("+item.idProducto+")\">Eliminar</a></div>"
            "</td>"+
            "</tr>";
            opciones+=` <option value="${item.idProducto}">${item.Nombre}</option>`
        });
       tabla.innerHTML+=renglones;
       lproductos.innerHTML+=opciones
    }
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}

function eliminarProducto(idProducto) {
    var liga =api+"productoController.php?tarea=eliminar&&id="+idProducto;

    console.log(liga)
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
       // document.getElementById('preview').innerHTML=this.responseText;
        tablaProductos()
    }
    };

    xhttp.open("GET",liga, true);
    xhttp.send();
}

function eliminarImg() {
    var idImagen = document.getElementById('imagenes').value;
    var liga = api+"productoController.php?tarea=consultaProductos";
    var band = false;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            console.log(data);
            let encontro=false;
            data.forEach(function(item){
                if(item.urlImagen==idImagen){
                    encontro=true;
                }
            });
            
            if(!encontro)
            {
                borrarImagen(idImagen);
            }
        }
    };
    xhttp.open("GET",liga, true);
    xhttp.send();
    return band;
}

function borrarImagen(id) {

    var liga = api+"imgenController.php?tarea=eliminar&&id="+id;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            alert(this.responseText);
            cargarImagenesCombo();
        }   
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
}

document.getElementById('lproductos').addEventListener('change',function(e) {
    e.preventDefault()
    var nombre = document.getElementById('nomProd');
    var descripcion = document.getElementById('descripcion');
    var idImagen = document.getElementById('imagenes');
    var descuento = document.getElementById('descuento');
    var precio = document.getElementById('precio');
    
    if(this.value!=0)
    {
        var liga = api+"productoController.php?tarea=consultaProducto&&id="+this.value;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) { 
                try {
                    let data = JSON.parse(this.responseText);
                    let texto = ""
                    //document.getElementById('preview').innerHTML=this.responseText;
                    console.log(data);
                    nombre.value = data.Nombre;
                    descripcion.value = data.Descripcion;
                    idImagen.value = data.urlImagen;
                    descuento.value = data.Descuento;
                    precio.value = data.Precio;
                    var vista = document.getElementById('vista');
                    var linea =  ' <img src="../Controllers/vista.php?id='+data.urlImagen+'" style="width: 130px; height: 130px;">'
                    
                    vista.innerHTML=linea
                    
                } catch (error) {
                    console.log(error)
                }
                
            }
        
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
    }
    else{
        nombre.value = "";
        descripcion.value = "";
        descuento.value = "";
        precio.value ="";
    }
}
)

document.getElementById('actualizar').addEventListener('click', function(e){
    e.preventDefault()

    var nombre = document.getElementById('nomProd').value;
    var descripcion = document.getElementById('descripcion').value;
    var idImagen = document.getElementById('imagenes').value;
    var descuento = document.getElementById('descuento').value;
    var precio = document.getElementById('precio').value;
    var id = document.getElementById('lproductos').value;
    if(descuento=="")
    {
        descuento=0;
    }
    if(id==0)
    {
        alert('No paso nada...')
        return false;
    }
    else{
        if(nombre!=""&&descripcion!=""&&idImagen!=""&&descuento!=""&&precio!="")
        { 
        var liga = api+"productoController.php?tarea=actualizar&nombre="+nombre+"&descripcion="+descripcion+"&idImagen="+idImagen+
                    "&descuento="+descuento+"&precio="+precio+"&&idProducto="+id;
            console.log(liga)
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) { 
                    alert(this.responseText)
                    tablaProductos()
                }
            };
            
            xhttp.open("GET",liga, true);
            xhttp.send();
        }
        else{
            alert("Se necesitan todos los campos")
        }
    }

})