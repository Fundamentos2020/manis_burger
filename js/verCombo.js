verProducto()

function verProducto() {
    var id= getParameterByName('id')
    var liga = api+"comboController.php?tarea=consultaCombo&&id="+id;

    var titulo = document.getElementById('titulo');
    var foto = document.getElementById('foto');
    var precio = document.getElementById('precio')
    var descripcion = document.getElementById('descripcion');
    var precio_desc = document.getElementById('precio_desc');

    var espacioImagenes = document.getElementById('espacioImagenes')

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            let texto = ""
            let imagenes=""
            //document.getElementById('preview').innerHTML=this.responseText;
            console.log("datos:");
            console.log(data)
            let aux=0;
            
            data.forEach(function(item) {
                
                if(item.idCombo!=aux)
                {
                    titulo.innerText=item.Nombre;
                    foto.style.backgroundImage =`url('./Controllers/vista.php?id=${item.idImagen}')`;
                    precio.innerText+=`${item.Precio}`;
                    descripcion.innerText =`${item.Descripcion}` ;
                    if(item.Descuento == 0)
                    {
                    
                    }
                    else{
                        texto = `<div class="precio-producto col-m-5 col-s-12" id="descuentotxt">Descuento: ${item.Descuento}%</div>`
                        precio_desc.innerHTML+=texto;

                    }
                    aux=item.idCombo;
                }

                imagenes+=`<img class="miniImagenes" src="./Controllers/vista.php?id=${item.idImagen}" onclick="verImagen(${item.idImagen})">`
            })
            espacioImagenes.innerHTML=imagenes
        }
       
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}



function getParameterByName(name) {
    name = name.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");
    var regex =  new RegExp("[\\?&]"+name+"=([^&#]*)");
    var result = regex.exec(location.search);

    return result==null ? "" : decodeURIComponent(result[1].replace(/\+/g," "))
    
}

function verImagen(idIma) {
    var foto = document.getElementById('foto');
    foto.style.backgroundImage =`url('./Controllers/vista.php?id=${idIma}')`;
    
}

document.getElementById('comprarCombo').addEventListener('click', function(e){
    e.preventDefault();
    var id= getParameterByName('id');
    var cantidad = document.getElementById('cantidad').value;
    var liga = api+"comboController.php?tarea=consultaCombo&&id="+id;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            //document.getElementById('preview').innerHTML=this.responseText;
            console.log(data);
            console.log("precio1: "+data.Precio)
           insertaPedido(id,data[0].Precio, cantidad)
        }
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
     
    

})

function fecha() {

    var hoy = new Date();
    var dia = hoy.getDay();
    var mes = hoy.getMonth();
    var año = hoy.getFullYear();

    return año+ '-'+mes+'-'+ dia;
    
}

function insertaPedido(id, precio, cantidad) {
    if(cantidad>0)
    {
        var hoy = fecha();
        console.log(hoy);
        console.log("precio: "+precio);
        var liga = api+"pedidoController.php?tarea=insertar&&idCombo="+id+"&cantidad="+cantidad+"&precio="+precio+"&fechaPedido="+hoy ;
       
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) { 
                let data = JSON.parse(this.responseText);

                alert(data.mensaje)
            }
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
    }
    else{
        alert('La cantidad tiene que ser mayor a cero...')
    }
}