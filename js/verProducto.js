
verProducto()

function verProducto() {
    var id= getParameterByName('id')
    var liga = api+"productoController.php?tarea=consultaProducto&&id="+id;

    var titulo = document.getElementById('titulo');
    var foto = document.getElementById('foto');
    var precio = document.getElementById('precio')
    var descripcion = document.getElementById('descripcion');
    var precio_desc = document.getElementById('precio_desc');
    var btn_comprar = `<a href="#" class="btn-comprar" id="btn">Comprar</a>`

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            let texto = ""
            //document.getElementById('preview').innerHTML=this.responseText;
            console.log(data);
            titulo.innerText=data.Nombre;
            foto.style.backgroundImage =`url('../Controllers/vista.php?id=${data.urlImagen}')`;
            precio.innerText+=`${data.Precio}`;
            descripcion.innerText =`${data.Descripcion}` ;
            if(data.Descuento == 0)
            {
               
            }
            else{
                texto = `<div class="precio-producto col-m-5 col-s-12" id="descuentotxt">Descuento: ${data.Descuento}%</div>`
                precio_desc.innerHTML+=texto;

            }
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
