
LeeJonson()

function LeeJonson(){
    const xhr = new XMLHttpRequest()
    var misProductos;
    xhr.open('GET','productos.json', true)

    xhr.onload=function(){
        if(this.status === 200){
            misProductos= JSON.parse(this.responseText)
            MuestraProductos(misProductos['productos'])
        }
    }
    xhr.send()
}

function MuestraProductos(listProductos)
{
    var espacioProd = document.getElementById("EspacioProductos")
    let texto = ""
    listProductos.forEach(function(item){
        texto += `
        <div class=" col-m-3 col-s-3 ">
            <div class="card">
                <div class="row card-title">
                    ${item.nombre}
                </div>
                <div class="row">
                    <div class="col-m-4 col-s-4">
                        <img src="${item.imagen}">
                    </div>
                </div>
                <div class="row card-contenido">
                    <h4>$${item.precio}</h4>
                    <a href="producto.html" class="btn-price" >Ir a Ver</a>
                </div>
            </div>
        </div>`
    })
    espacioProd.innerHTML = texto;
}