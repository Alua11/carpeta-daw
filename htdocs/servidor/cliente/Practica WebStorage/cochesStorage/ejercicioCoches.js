var cocheActual = -1;
function validarDatos() {

    let error = '';
    let primeroVacio = false;
    let coches = JSON.parse(getLocalStorage('coches'));
    let repe = false; 
    for (let cocheIndex of Object.keys(coches)) {
        let coche = coches[cocheIndex];
        if (document.getElementById('matricula').value === coche['matricula']) {
            error += `La matricula ${coche['matricula']} ya está en uso<br>`;
        }
    }
    for (let i = 0; !repe && i < formulario.children.length; i++) {
            if (formulario.children[i].value === '') {
                error += `El campo ${formulario.children[i].name} no puede estar vacio<br>`;
                if (!primeroVacio) {
                    formulario.children[i].focus();
                    primeroVacio = true;
                }
            }
    }

    return error;
}

function leerDatos() {
    let datos = {};
    let formulario = document.getElementById('formulario');
    for (let i = 0; i < formulario.children.length; i++) {
        if (formulario.children[i].value && formulario.children[i].type !== 'button' && formulario.children[i].type !== 'reset') {
            datos[formulario.children[i].name] = formulario.children[i].value;
        }
    }
    return datos;
}
function setLocalStorage(sName, value) {
    localStorage.setItem(sName, value);
}
function getLocalStorage(sName) {
    return localStorage.getItem(sName);
}
function initLocalStorage(sName, defaultValue) {
    if (!localStorage.getItem(sName)) {
        localStorage.clear();
        localStorage.setItem(sName, defaultValue);
    }
}
function guardar(datos) {
    let coches = JSON.parse(getLocalStorage('coches'));
    coches.push(datos);
    // console.log(coches);
    setLocalStorage('coches', JSON.stringify(coches));
}
function limpiar() {
    for (let i = 0; i < formulario.children.length; i++) {
        if (formulario.children[i].value && formulario.children[i].type !== 'button' && formulario.children[i].type !== 'reset') {
            formulario.children[i].value = "";
        }
    }
}
function setCoche() {
    let coches = JSON.parse(getLocalStorage('coches'));
    if (cocheActual != -1) {
        let coche = coches[cocheActual];
        document.getElementById('matricula').value = coche.matricula;
        document.getElementById('color').value = coche.color;
        document.getElementById('marca').value = coche.marca;
    }
}
function eliminarCoche() {
    let coches = JSON.parse(getLocalStorage('coches'));
    let encontrado = false;
    for (let cocheIndex of Object.keys(coches)) {
        let coche = coches[cocheIndex];
        let candidato = true;
        for (valor in coche) {
            if (candidato && document.getElementById(valor).value !== coche[valor]) {
                candidato = false;
            }
        }
        if (candidato) {
            coches.splice(cocheIndex, 1);
            setLocalStorage('coches', JSON.stringify(coches));
            cocheActual = -1;
            encontrado = true;
            limpiar();
            break;
        }
    }
    if (!encontrado) {
        document.getElementById("errores").innerHTML = "No se ha encontrado el coche para borrar <br />";
    }
}
window.onload = function () {
    initLocalStorage('coches', '[]');
    let boton = document.getElementById('guardar');
    let siguiente = document.getElementById('siguiente');
    let anterior = document.getElementById('anterior');
    let eliminar = document.getElementById('eliminar');
    boton.addEventListener('click', (e) => {
        let errores = validarDatos();
        document.getElementById("errores").innerHTML = errores;
        if (errores === '') {
            let datos = leerDatos();
            guardar(datos);
            limpiar();
        }
    });
    siguiente.addEventListener('click', (e) => {
        document.getElementById("errores").innerHTML = '';
        let coches = JSON.parse(getLocalStorage('coches'));
        cocheActual++;
        if (cocheActual >= coches.length) {
            cocheActual = 0;
        }
        if (coches.length > 0) {
            setCoche();
        }
        else {
            document.getElementById("errores").innerHTML = 'No hay coches para mostrar';
        }
    });
    anterior.addEventListener('click', (e) => {
        document.getElementById("errores").innerHTML = '';
        let coches = JSON.parse(getLocalStorage('coches'));
        cocheActual--;
        if (cocheActual < 0) {
            cocheActual = coches.length - 1;
        }
        if (coches.length > 0) {
            setCoche();
        }
        else {
            document.getElementById("errores").innerHTML = 'No hay coches para mostrar';
        }
    });
    eliminar.addEventListener('click', (e) => {
        document.getElementById("errores").innerHTML = '';
        eliminarCoche();
    });
}

