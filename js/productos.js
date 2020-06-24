//const api ='http://localhost:80/manis_burger/Controllers/';
//const dir = 'http://localhost:80/manis_burger/';
LeeJonson()

function LeeJonson(){
    var liga = api+"productoController.php?tarea=consultaProductos";
    var espacioProd = document.getElementById("EspacioProductos")
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        let data = JSON.parse(this.responseText);
        let texto = ""
        //document.getElementById('preview').innerHTML=this.responseText;
       // console.log(data);
        data.forEach(function(item){
            texto += `
            <div class=" col-m-3 col-s-12 ">
                <div class="card">
                    <div class="row card-title">
                        ${item.Nombre}
                    </div>
                    <div class="row">
                        <div class="col-m-4 col-s-12">
                        <img src="../Controllers/vista.php?id=${item.urlImagen}">
                        </div>
                    </div>
                    <div class="row card-contenido">
                        <h4>$${item.Precio}</h4>
                        <a href="./producto.html?id=${item.idProducto}" class="btn-price" >Ir a Ver</a>
                    </div>
                </div>
            </div>`
        });
       espacioProd.innerHTML+=texto;
    }
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}
