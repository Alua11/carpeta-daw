function mostrarEquipo() {
    let cadenaEquipo = document.getElementById("equipo").value;

    if (cadenaEquipo != null) {
        let equipo = JSON.parse(cadenaEquipo);

        for (let i = 0; i < 3; i++) {
            let componenteEquipo = document.getElementById('equipo' + (i + 1));
            componenteEquipo.innerHTML = equipo.datos[i].name;
        }

    } else {
        alert("El equipo se ha perdido.");
    }
}

function mostrarAspirantes() {
    let cadenaPersonajes = document.getElementById("personajes").value;

    if (cadenaPersonajes != null) {
        let personajes = JSON.parse(cadenaPersonajes);
        let aspirantes = document.getElementById('CapaPersonajes');

        for (let i = 0; i < personajes.datos.length; i++) {
            let aspirante = document.createElement('div');
            aspirante.innerHTML = personajes.datos[i].name;
            aspirante.id = "aspirante" + (i + 1);
            aspirante.className = "aspiranteClass";
            aspirante.setAttribute("onclick", `seleccionarAspirante(${i})`);
            aspirantes.appendChild(aspirante);
        }
        
    } else {
        alert("No hay aspirantes a entrar en el equipo.");
    }
}

function seleccionarComponente(iComponente) {

    let posiblesSelecconados = document.getElementsByClassName("equipoClass");
    for (let i = 0; i < posiblesSelecconados.length; i++) {
        posiblesSelecconados[i].className = "equipoClass";
    }

    let divSeleccionado = document.getElementById('equipo' + (iComponente + 1));
    divSeleccionado.className = "equipoClass seleccionado";

    // let cadenaEquipo = document.getElementById("equipo").value;
    // let equipo = JSON.parse(cadenaEquipo);
    // return equipo[iComponente];
}

function seleccionarAspirante(iAspirante) {

    let posiblesSelecconados = document.getElementsByClassName("aspiranteClass");
    for (let i = 0; i < posiblesSelecconados.length; i++) {
        posiblesSelecconados[i].className = "aspiranteClass";
    }

    let divSeleccionado = document.getElementById('aspirante' + (iAspirante + 1));
    divSeleccionado.className = "aspiranteClass seleccionado";

    // let cadenaPersonajes = document.getElementById("personajes").value;
    // let personajes = JSON.parse(cadenaPersonajes);
    // return personajes[iAspirante];
}

function cambiar() {
    let equipo = document.getElementsByClassName("equipoClass");
    let seleccionadoEquipo = "";
    for (let i = 0; i < equipo.length; i++) {
        if (equipo[i].className == "equipoClass seleccionado") {
            seleccionadoEquipo = equipo[i];
        }
    }

    let aspirantes = document.getElementsByClassName("aspiranteClass");
    let seleccionadoAspirante = "";
    for (let i = 0; i < aspirantes.length; i++) {
        if (aspirantes[i].className == "aspiranteClass seleccionado") {
            seleccionadoAspirante = aspirantes[i];
        }
    }

    if (seleccionadoEquipo != "" && seleccionadoAspirante != "") {
        cambio = true;
        for (let i = 0; i < equipo.length; i++) {
            if (equipo[i].innerHTML == seleccionadoAspirante.innerHTML) {
                cambio = false;
            }
        }
        if (cambio) {
            seleccionadoEquipo.innerHTML = seleccionadoAspirante.innerHTML;
            crearNuevoEquipo();
            console.log(document.getElementById("equipo").value);
        } else {
            alert("Ese aspirante ya está en el equipo.")
        }
    } else {
        alert("Faltan por seleccionar.");
    }
}

function crearNuevoEquipo() {
    let cadenaPersonajes = document.getElementById("personajes").value;
    let personajes = JSON.parse(cadenaPersonajes);
    let cadenaEquipo = document.getElementById("equipo").value;
    let equipo = JSON.parse(cadenaEquipo);

    let equipoMostrado = document.getElementsByClassName("equipoClass");

    for (let i = 0; i < equipoMostrado.length; i++) {
        let nombre = equipoMostrado[i].innerHTML
        for (let j = 0; j < personajes.datos.length; j++) {
            if (nombre == personajes.datos[j].name) {
                equipo.datos[i] = personajes.datos[j];
            }
        }
    }

    document.getElementById("equipo").value = JSON.stringify(equipo);
}


mostrarEquipo();
mostrarAspirantes();