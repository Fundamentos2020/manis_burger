
verProductos();

function verProductos() {
    var liga = api+"productoController.php?tarea=consultaProductos";
    var espacioProd = document.getElementById("EspacioProductos")
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        let data = JSON.parse(this.responseText);
        let texto = ""
        let cont=0
        //document.getElementById('preview').innerHTML=this.responseText;
       // console.log(data);
       while(cont <4 && data[cont]!=null)
       {
            texto += `
            <div class=" col-m-3 col-s-12 ">
                <div class="card">
                    <div class="row card-title">
                        ${data[cont].Nombre}
                    </div>
                    <div class="row">
                        <div class="col-m-4 col-s-12">
                        <img src="./Controllers/vista.php?id=${data[cont].urlImagen}">
                        </div>
                    </div>
                    <div class="row card-contenido">
                        <h4>$${data[cont].Precio}</h4>
                        <a href="./producto.html?id=${data[cont].idProducto}" class="btn-price" >Ir a Ver</a>
                    </div>
                </div>
            </div>`
           cont+=1;
       }
       espacioProd.innerHTML+=texto;
    }
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
    
}