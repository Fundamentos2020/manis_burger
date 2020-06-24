
const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/';

verVentas()

function verVentas()
{
    var liga = api+'pedidoController.php?tarea=consultaProductosDetC';
    var tabla = document.getElementById('t01')
    tabla.innerHTML = `<tr>
                <th>Nombre</th>
                <th>Precio</th> 
                <th>Cantidad</th> 
                <th>Subtotal</th>
            </tr>`
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
           //document.getElementById('espacio').innerHTML=this.responseText;
            let data = JSON.parse(this.responseText);
            let texto = ""
            let total = 0;
           // document.getElementById('preview').innerHTML=this.responseText;
            console.log(data);
            if(data.mensaje !=null)
            {
                document.getElementById('comprasEspacio'),innerText=data.error;
            }
            else{
                data.forEach(function(item){
                    texto += `<tr>
                                <td>${item.nombre}</td>
                                <td>${item.precio}</td>
                                <td>
                                   ${item.cantidad}
                                </td>
                                <td>
                                   ${item.subtotal}
                                </td>
                            </tr>`;
                    total=parseFloat(item.subtotal)+total;
                });
            }
           tabla.innerHTML+=texto
           document.getElementById('total').innerText = 'Total-Ventas: $'+total;
        }
       
    };
    
    xhttp.open("GET",liga, true);
    xhttp.send();
}