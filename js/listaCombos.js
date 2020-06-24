cargarDC()
function cargarDC() {
    var liga = api+"comboController.php?tarea=innerJoinCombo";
    var espacio = document.getElementById('EspacioProductos')
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        try {
            let data = JSON.parse(this.responseText);
            let anterior=0;
            let texto = "";
            console.log(data)
            data.forEach(function(item) {
                if(anterior!=item.idCombo)
                {
                    texto+=`<div class=" col-m-3 col-s-12 ">
                            <div class="card">
                                <div class="row card-title">
                                    ${item.Nombre}
                                </div>
                                <div class="row">
                                    <div class="col-m-4 col-s-12">
                                    <img src="../Controllers/vista.php?id=${item.idImagen}">
                                    </div>
                                </div>
                                <div class="row card-contenido">
                                    <h4>$${item.Precio}</h4>
                                    <a href="./combo.html?id=${item.idCombo}" class="btn-price" >Ir a Ver</a>
                                </div>
                            </div>
                        </div>`;
                        anterior=item.idCombo;
                }
                espacio.innerHTML=texto;
                //consultaProductos(celda,item.idProducto, item.idDetalleCombo);
            })
            
        } catch (error) {
            console.log(this.responseText)
        }
        
    }
    
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
    
}

function consultaProductos(celda, idP, idD) {
    var liga = api+"productoController.php?tarea=consultaProducto&&id="+idP;   
    console.log(idD) 
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        let texto=""
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            texto = `<div class="row" style="margin-bottom: 30px">* ${data.Nombre} <a href="#" style="margin-left:5px;" class="btn btn-eliminar" onclick="eliminarDC(${idD})">X</a></div>`
        }
        celda.innerHTML+=texto;
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send(); 
}
