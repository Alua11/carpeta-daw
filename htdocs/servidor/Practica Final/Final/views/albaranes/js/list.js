
function listar() {
    const myInit = {
        method: "GET", //GET POST PUT DELETE etc..
        mode: "cors",
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    };
    let peticion = new Request('http://localhost/Practica_Final/Final/endpoints/albaranes/getAlbaranes.php', myInit);

    fetch(peticion)
        .then((resp) => resp.json())
        .then(function (datos) {

            let tbody = document.getElementsByTagName("tbody")[0];
            tbody.innerHTML = '';
            for (let i = 0; i < datos.length; i++) {
                let filaHTML = document.createElement('tr');
                filaHTML["data-fila"] = datos[i].cod_albaran;
                let fila =
                    "<td>" + (datos[i].cod_albaran ? datos[i].cod_albaran : "") + "</td>" +
                    "<td>" + (datos[i].fecha ? datos[i].fecha : "") + "</td>" +
                    "<td>" + (datos[i].facturado ? datos[i].facturado : "") + "</td>" +
                    "<td>" + (datos[i].cod_cliente ? datos[i].cod_cliente : "") + "</td>" +
                    "<td>" + (datos[i].nick ? datos[i].nick : "") + "</td>" +
                    "<td><a class='btn btn-success'  data-id='" + datos[i].cod_pedido + "'href='index.php?accion=detalle&tabla=albaranes&id=" + datos[i].cod_pedido + "'> <i class='fas  fa-paint-brush'></i> Ver </a></td>" +
                    "<td><a class='btn btn-success'  data-id='" + datos[i].cod_pedido + "'href='index.php?accion=editar&tabla=albaranes&id=" + datos[i].cod_pedido + "'> <i class='fas  fa-paint-brush'></i> Borrar </a></td>";
                filaHTML.id = "fila" + datos[i].cod_pedido;
                filaHTML.innerHTML = fila;
                tbody.appendChild(filaHTML);
            }
        })

}
// on init
listar();