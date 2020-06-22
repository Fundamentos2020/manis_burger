/*const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';*/
let total =0;
verCarrito()
verCarrito2()

function verCarrito() {
    var liga = api+'pedidoController.php?tarea=consultaCarrito';

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            let texto = ""
            total=0
            //document.getElementById('preview').innerHTML=this.responseText;
            console.log('productos: ')
            console.log(data);
            if(data.error !=null)
            {
                document.getElementById('comprasEspacio'),innerText=data.error;
            }
            else{
                data.forEach(function(item){
                    texto += `<div class="row margin-bootom-20px">
                            <div class="col-m-2 col-s-9 offset-m-1 box-img">
                                <img src="./Controllers/vista.php?id=${item.imagen}" alt="">
                            </div>
                            <div class="col-m-5 col-s-10 offset-m-1 offset-s-1">
                                <div class="row">
                                    <div class=" row titulo-produducto">
                                        ${item.nombre}
                                    </div>
                                    <div class=" row precio-producto">
                                        Precio: $${item.subtotal}
                                    </div>
                                    <div class="row">
                                        <a href="#" class="btn btn-eliminar" onclick="eliminarProducto(${item.idDetallePedido})">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                    total=parseFloat(item.subtotal)+total;
                });
            }
           document.getElementById('comprasEspacio').innerHTML=texto;
           document.getElementById('total').innerText = 'Total: $'+total;
        }
       
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}

function eliminarProducto(idDetallePedido) {
    var liga = api+'pedidoController.php?tarea=eliminaDetalle&idDetallePedido='+idDetallePedido;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
           
          verCompras()
        }
       
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}

document.getElementById('btn-pagar').addEventListener('click', function (e) {
    e.preventDefault()
    var liga = api+'pedidoController.php?tarea=borrarIDpedido';

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById('comprasEspacio').innerHTML=`<div class="row margin-bootom-20px">
            <div class="col-m-2 col-s-12 offset-m-1 box-img">
            <span class="pagado">Pagado</span>
            </div>
            </div>`
           
        }
       
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
    
    
})

function verCarrito2() {
    var liga = api+'pedidoController.php?tarea=consultaCarrito2';

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            let texto = ""
            let aux=0;
            //document.getElementById('preview').innerHTML=this.responseText;
            console.log(data);
            if(data.error !=null)
            {
                document.getElementById('comprasEspacio'),innerText=data.error;
            }
            else{

                data.forEach(function(item){
                    
                    if(aux!=item.idDetallePedido)
                    {
                        texto += `<div class="row margin-bootom-20px">
                            <div class="col-m-2 col-s-12 offset-m-1 box-img">
                                <img src="./Controllers/vista.php?id=${item.imagen}" alt="">
                            </div>
                            <div class="col-m-5 col-s-10 offset-m-1 offset-s-1">
                                <div class="row">
                                    <div class=" row titulo-produducto">
                                        ${item.nombre}
                                    </div>
                                    <div class=" row precio-producto">
                                        Precio: $${item.subtotal}
                                    </div>
                                    <div class="row">
                                        <a href="#" class="btn btn-eliminar" onclick="eliminarProducto(${item.idDetallePedido})">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                         total=parseFloat(item.subtotal)+total
                    }
                    aux=item.idDetallePedido;
                });
            }
           document.getElementById('comprasEspacio').innerHTML+=texto;
           document.getElementById('total').innerText = 'Total: $'+total;
        }
       
    };

    xhttp.open("GET",liga, true);
    xhttp.send();
}


function verCompras()
{
    verCarrito()
    verCarrito2()
}