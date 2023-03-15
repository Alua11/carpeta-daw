let desplegable = document.getElementById('provincia');
let pepin = document.getElementById('pepin');
desplegable.onchange = function (e) {
    e.preventDefault();
    let provincia = this.value;
    CargarPoblacion(provincia);
};
function CargarPoblacion(provincia) {
    //const datos = new FormData(document.getElementById('formulario'));
    const datos = new FormData();
    datos.append('provincia', provincia);
    const myInit = {
        method: 'POST', //GET POST PUT DELETE etc..
        mode: 'cors',
        cache: 'no-cache', // *default, no-cache, reload, force-cache, onlyif-cached
        body: datos
    };
    let peticion = new Request('cargar_poblacion.php', myInit);
    //NOTACION COMPRIMIDA
    fetch(peticion)
        .then(respuesta => respuesta.text())
        .then(texto => (pepin.innerHTML = texto)
        )
        .catch(function (error) {
            pepin.innerHTML = "";
            let p = document.createElement('p');
            p.appendChild(
                document.createTextNode('Error: ' + error.message)
            );
            pepin.appendChild(p);
        });
}