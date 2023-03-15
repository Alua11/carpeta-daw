function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function eraseCoockie(cname) {
    setCookie(cname, "", -1);
}

function campoVacio(campo) {
    let contenido = document.getElementById(campo).value;

    if (contenido == NULL || contenido == "") {
        return true;
    }

    return false;
}

function selectCero(campos) {
    let contenido = document.getElementById(campo).value;

    if (contenido == 0) {
        return true;
    }

    return false;
}

function validarDatos() {

    let error = '';
    let primeroVacio = false;

    for (let i = 0; i < formulario.children.length; i++) {
        if (formulario.children[i].name !== "provincia") {
            if (formulario.children[i].value === '') {
                error += `El campo ${formulario.children[i].name} no puede estar vacio<br>`;
                if (!primeroVacio) {
                    formulario.children[i].focus();
                    primeroVacio = true;
                }
            }
        } else {
            if (formulario.children[i].value === '0') {
                error += `No has seleccionado nada en el campo provincia <br>`;
                if (!primeroVacio) {
                    formulario.children[i].focus();
                    primeroVacio = true;
                }
            }
        }
    }

    return error;
}

function leerDatos() {
    let datos = {};


    let formulario = document.getElementById('formulario');
    for (let i = 0; i < formulario.children.length; i++) {
        if (formulario.children[i].value) {
            datos[formulario.children[i].name] = formulario.children[i].value;
        }
    }
    return datos;
}

function enviar() {
    let intentos = getCookie('intentos');
    console.log(intentos);
    intentos++;
    document.getElementById("intentos").innerHTML = intentos; 
    setCookie('intentos', intentos, 10);
}

window.onload = function () {

    if (getCookie('intentos') == "") {
        setCookie('intentos', "0", 10);
    }
    let intentos = getCookie('intentos');
    document.getElementById("intentos").innerHTML = intentos;
    let boton = document.getElementById('enviar');

    boton.addEventListener('click', (e) => {

        let errores = validarDatos();
        document.getElementById("errores").innerHTML = errores;
        leerDatos();
        enviar();
        if (errores !== '') {
            e.preventDefault();
        }
        else{
            setCookie('intentos', "0", 10);
        }
    });
}

