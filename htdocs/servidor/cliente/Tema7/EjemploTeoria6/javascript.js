function createNode(element) {
    return document.createElement(element);
}
function append(parent, el) {
    return parent.appendChild(el);
}
let desplegable = document.getElementById("provincia");
let pepin = document.getElementById("pepin");
desplegable.onchange = function (e) {
    e.preventDefault();
    let provincia = this.value;
    CargarPoblacion(provincia);
};
function CargarPoblacion(provincia) {
    //const datos = new FormData(document.getElementById('formulario'));
    const datos = new FormData();
    datos.append("provincia", provincia);
    const myInit = {
        method: "POST", //GET POST PUT DELETE etc..
        mode: "cors",
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        body: datos,
    };
    let peticion = new Request("cargar_poblacion.php", myInit);
    //NOTACION COMPRIMIDA
    fetch(peticion)
        .then((resp) => resp.json())
        .then(function (provincias) {
            pepin.innerHTML = "";
            //console.log(provincias);
            if (provincias.length > 0) {
                let select = createNode("select");
                select.id = "poblaciones";
                select.name = "poblaciones";
                for (let p of provincias) {
                    let option = createNode("option");
                    option.text = p.nombre;
                    append(select, option);
                }
                append(pepin, select);
            }
            else {
                pepin.innerHTML = "Aqui Van las poblaciones";
            }
        })
        .catch(function (error) {
            pepin.innerHTML = "";
            let p = document.createElement('p');
            p.appendChild(
                document.createTextNode('Error: ' + error.message)
            );
            append(pepin, p);
        });
}