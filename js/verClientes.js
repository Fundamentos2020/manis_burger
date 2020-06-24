
const api ='http://localhost:80/manis_burger/Controllers/';
const dir = 'http://localhost:80/manis_burger/'
verClientes()

function verClientes() {
    var liga = api+"usuarioController.php?tarea=consultaUsuarios";
    var tabla = document.getElementById('t01');

    tabla.innerHTML =`  <tr>
                            <th>ID CLIENTE</th>
                            <th>NOMBRE</th> 
                            <th>Direccion</th>
                            <th>E-MAIL</th>
                            <th>Administrador</th>
                            <th>Seleccionar</th>
                        </tr>`;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse( this.responseText);
                let renglones = "";
                console.log(data)
                data.forEach(function(item){
                    renglones+=`<tr>
                                    <td>${item.idUsuario}</td>
                                    <td>${item.nombre+" "+item.apellido}</td>
                                    <td>
                                        ${item.direccion}
                                    </td>
                                    <td>
                                        ${item.email}
                                    </td>
                                    <td>
                                        ${item.administrador}
                                    </td>
                                    <td>
                                        <a style="margin: 20px;" href="#" class="btn btn-eliminar" onclick="eliminar(${item.idUsuario})">Eliminar</a>
                                    </td>
                                </tr>`;
                })
                tabla.innerHTML+=renglones;
            }
        };
        
        xhttp.open("GET",liga, true);
        xhttp.send();
}

function eliminar(id) {
    var liga = api+"usuarioController.php?tarea=eliminar&id="+id;
    console.log(liga)
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
       // document.getElementById('preview').innerHTML=this.responseText;
        verClientes()
    }
    };

    xhttp.open("GET",liga, true);
    xhttp.send();
}