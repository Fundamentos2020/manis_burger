/*const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';*/

var idPedido;
var precio= 0;
var descuento = 0;

document.getElementById('btn-comprar').addEventListener('click', function(e){
    e.preventDefault();
    var id= getParameterByName('id');
    var cantidad = document.getElementById('cantidad').value;
    var liga = api+"productoController.php?tarea=consultaProducto&&id="+id;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            let data = JSON.parse(this.responseText);
            //document.getElementById('preview').innerHTML=this.responseText;
            console.log(data);
            console.log("precio1: "+data.Precio)
           insertaPedido(id,data.Precio, cantidad)
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
        var liga = api+"pedidoController.php?tarea=insertar&&idProducto="+id+"&cantidad="+cantidad+"&precio="+precio+"&fechaPedido="+hoy ;
       
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