/*const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';*/
let total =0;
verCarrito()
//verCarrito2()

function verCarrito() {
    //var liga = api+'pedidoController.php?tarea=consultaCarrito';
    let texto = ""
    total=0
    if(localStorage.getItem('carrito'))
    {
       var carrito=JSON.parse(localStorage.getItem('carrito'))
        var idImagen=0
        var id=0;
        var conta = 0;
       carrito.forEach(function(item){
            if(item.urlImagen)
            {
                
                idImagen= item.urlImagen
            }
            else{
                idImagen= item.idImagen
            }

            if(item.idCombo)
            {
                id=item.idCombo;
            }
            else{
                id=item.idProducto;
            }
            texto += `<div class="row margin-bootom-20px">
                        <div class="col-m-2 col-s-12 offset-m-1 box-img">
                            <img src="../Controllers/vista.php?id=${idImagen}" alt="">
                        </div>
                        <div class="col-m-5 col-s-10 offset-m-1 offset-s-1">
                            <div class="row">
                                <div class=" row titulo-produducto">
                                    ${item.Nombre}
                                </div>
                                <div class=" row precio-producto">
                                    Cantidad: ${item.cantidad} Subtotal: $${parseFloat(item.cantidad)*parseFloat(item.Precio)}
                                </div>
                                <div class="row">
                                    <a href="#" class="btn btn-eliminar" onclick="eliminarProducto(${conta})">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>`;

                total=(parseFloat(item.cantidad)*parseFloat(item.Precio))+total;
                conta+=1
       }
       )

    }
    document.getElementById('comprasEspacio').innerHTML=texto;
    document.getElementById('total').innerText = 'Total: $'+total; 

}

function eliminarProducto(id) {
    if(localStorage.getItem('carrito')){
        var carrito= JSON.parse(localStorage.getItem('carrito'))
        
       // delete carrito[id]
        carrito.splice(id,1)
        if(carrito.length==0)
        {
            console.log(carrito)
            localStorage.removeItem('carrito')
        }
        else{
            localStorage.removeItem('carrito')
            localStorage.setItem('carrito', JSON.stringify(carrito))
            console.log(carrito)
        }
    }
    verCarrito();
}

document.getElementById('btn-pagar').addEventListener('click', function (e) {
    e.preventDefault()

    if(localStorage.getItem('carrito'))
    {
        var carrito = JSON.parse(localStorage.getItem('carrito'))
        carrito.forEach(function(item){
            if(item.idCombo)
            {
                insertaPedido(item.idCombo, item.Precio, item.cantidad, 'combo')

            }
            else{
                insertaPedido(item.idProducto, item.Precio, item.cantidad, 'producto')
            }
        })
        localStorage.removeItem('carrito')
        borrarIdPedido()
    }
    else{
        alert('no hay nada')
    }
    
})


function fecha() {

    var hoy = new Date();
    var dia = hoy.getDay();
    var mes = hoy.getMonth();
    var año = hoy.getFullYear();

    return año+ '-'+mes+'-'+ dia;
    
}

function insertaPedido(id, precio, cantidad, metodo) {
    if(cantidad>0)
    {
        var hoy = fecha();
        if(metodo=='combo')
        {
            var liga = api+"pedidoController.php?tarea=insertar&&idCombo="+id+"&cantidad="+cantidad+"&precio="+precio+"&fechaPedido="+hoy ;
        }
        else{
            var liga = api+"pedidoController.php?tarea=insertar&&idProducto="+id+"&cantidad="+cantidad+"&precio="+precio+"&fechaPedido="+hoy ;
        }
        
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) { 

                console.log(this.responseText)
            }
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
    }
    else{
        alert('La cantidad tiene que ser mayor a cero...')
    }
}

function borrarIdPedido() {
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
}