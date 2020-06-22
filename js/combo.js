const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';

cargarCombos();
cargaProductosCombo();

function cargarCombos(){
    var listaCombo =document.getElementById('listCombo');
    var tabla = document.getElementById('t01');
    
    tabla.innerHTML =`  <tr>
                            <th>Nombre Combo</th>
                            <th>Precio</th> 
                            <th>Descripcion</th>
                            <th>Descuento</th>
                            <th>Productos</th>
                            <th>Seleccionar</th>
                        </tr>`;

    var liga = api+"comboController.php?tarea=consultaCombos";
    //var espacioProd = document.getElementById("EspacioProductos");

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        try {
            let data = JSON.parse(this.responseText);
            let texto = ""
            let opciones=""
            //document.getElementById('preview').innerHTML=this.responseText;
            // console.log(data);
            data.forEach(function(item){
                texto += `  <tr><td>${item.Nombre}</td>
                            <td>${item.Precio}</td>
                            <td>
                                <p>
                                    ${item.Descripcion}
                                </p> 
                            </td>  
                            <td>${item.Descuento}</td>
                            <td id="p${item.idCombo}">No hay nada aun...</td> 
                            <td> <a href="#" class="btn btn-eliminar" onclick="eliminarCombo(${item.idCombo})">Eliminar</a></td></tr>`

                opciones += ` <option value="${item.idCombo}">${item.Nombre}</option>`
            });
            tabla.innerHTML+=texto;
            listaCombo.innerHTML=opciones;
        } catch (error) {
            console.log(error)
           
        }
        cargarDC()        
        
    }
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}


document.getElementById('agregarCombo').addEventListener('click', function(e){
    e.preventDefault();
    var nombreCombo = document.getElementById('nombreCombo').value;
    var precio= parseFloat( document.getElementById('precio').value);
    var descuento= parseFloat(document.getElementById('descuento').value);
    var descripcion=document.getElementById('descripcion').value;
    
    if(typeof(precio)!='number' && typeof(descuento)!='number')
    {
        alert('En precio y descuento solo se admiten numeros')
    }
    else{
        if(nombreCombo!="" && precio != null && descuento!= null && descripcion!="")
        { 
            var liga = api+"comboController.php?tarea=insertaCombo&&nombre="+nombreCombo+"&&precio="+precio+"&&descuento="+descuento+"&&descripcion="+descripcion;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) { 
                try {
                    let data = JSON.parse(this.responseText);
                    
                    if(data.mensaje!=null)
                    {
                        alert(data.mensaje);
                        cargarCombos();
                    }
                } catch (error) {
                   console.log(this.responseText)
                }
                
            }
            
            };
            
            xhttp.open("GET",liga, true);
            xhttp.send();
        }
        else{
            alert('Algunos Campos estan vacios')
        }
    }

})


function cargaProductosCombo() {
    var liga = api+"productoController.php?tarea=consultaProductos";
    var espacioProd = document.getElementById("listaproductos")
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        let data = JSON.parse(this.responseText);
        let texto = ""
        //document.getElementById('preview').innerHTML=this.responseText;
       // console.log(data);
        data.forEach(function(item){
            texto += `<option value="${item.idProducto}">${item.Nombre}</option>`
        });
       espacioProd.innerHTML+=texto;
    }
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}

document.getElementById('agregarProducto').addEventListener('click',function(e) {
    e.preventDefault()
    var idCombo = document.getElementById('listCombo').value;
    var idProducto = document.getElementById('listaproductos').value;
    var liga = api+"comboController.php?tarea=insertaDC&&idC="+idCombo+"&&idP="+idProducto;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        try {
            let data = JSON.parse(this.responseText);
            
            if(data.mensaje!=null)
            {
                alert(data.mensaje);
                
            }
            cargarDC()
        } catch (error) {
            console.log(this.responseText)
        }
        
    }
    
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
    

})


function cargarDC() {
    var liga = api+"comboController.php?tarea=consultaDC";
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        try {
            let data = JSON.parse(this.responseText);
            
            console.log(data)
            data.forEach(function(item) {
                let celda = document.getElementById('p'+item.idCombo);
                celda.innerText="";
                consultaProductos(celda,item.idProducto, item.idDetalleCombo);
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

function eliminarCombo(id) {
    var liga = api+"comboController.php?tarea=eliminarCombo&&idC="+id;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        try {
            let data = JSON.parse(this.responseText);
            
            if(data.mensaje!=null)
            {
                alert(data.mensaje)   
                cargarCombos(); 
            }
            
        } catch (error) {
            console.log(error)
        }
        
    }
    
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}

function eliminarDC(id) {
    var liga = api+"comboController.php?tarea=eliminarDC&&idDC="+id;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
        try {
            let data = JSON.parse(this.responseText);
            
            if(data.mensaje!=null)
            {
                alert(data.mensaje)   
                cargarCombos(); 
            }
            
        } catch (error) {
            console.log(this.responseText)
        }
        
    }
    
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}