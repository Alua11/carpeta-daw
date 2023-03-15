function genera_tabla() {
    // Obtener la referencia del elemento body
    var capa = document.getElementById("capaPersonajes");

    // Crea un elemento <table> y un elemento <tbody>
    var tabla = document.createElement("table");
    var tblBody = document.createElement("tbody");

    // Crea las celdas
    for (var i = 0; i < 6; i++) {
        // Crea las filas de la tabla
        var fila = document.createElement("tr");

        for (var j = 0; j < 6; j++) {
            // Crea un elemento <td> y un nodo de texto, haz que el nodo de
            // texto sea el contenido de <td>, ubica el elemento <td> al final
            // de la fila de la tabla
            var celda = document.createElement("td");
            var textoCelda = document.createTextNode(
                "celda en la fila " + i + ", columna " + j
            );
            celda.appendChild(textoCelda);
            fila.appendChild(celda);
        }

        // agrega la fila al final de la tabla (al final del elemento tblbody)
        tblBody.appendChild(fila);
    }

    // posiciona el <tbody> debajo del elemento <table>
    tabla.appendChild(tblBody);
    // appends <table> into <body>
    capa.appendChild(tabla);
    // modifica el atributo "border" de la tabla y lo fija a "2";
    tabla.setAttribute("border", "2");
    //  tabla.border=2;
}

function genera_tablaPersonajes() {
    let latabla = document.getElementById("latabla");
    if (latabla === null) {
        // Obtener la referencia del elemento body
        var capa = document.getElementById("capaPersonajes");
        let cadenaDatos = document.getElementById("datos").value;
        let datos = JSON.parse(cadenaDatos);
        datos = datos.results;

        // Crea un elemento <table> y un elemento <tbody>
        var tabla = document.createElement("table");
        tabla.id = "latabla";
        var tblBody = document.createElement("tbody");

        // Crea las celdas
        for (var i = 0; i < datos.length; i++) {
            // Crea las filas de la tabla
            var fila = document.createElement("tr");
            fila.setAttribute("especie",datos[i].species);
            // Crea un elemento <td> y un nodo de texto, haz que el nodo de
            // texto sea el contenido de <td>, ubica el elemento <td> al final
            // de la fila de la tabla
            var celda = document.createElement("td");
            var textoCelda = document.createTextNode(datos[i].name);
            celda.appendChild(textoCelda);
            fila.appendChild(celda);

            var celda = document.createElement("td");
            var textoCelda = document.createTextNode(datos[i].species);
            celda.appendChild(textoCelda);
            fila.appendChild(celda);

            var celda = document.createElement("td");
            var textoCelda = document.createTextNode(datos[i].gender);
            celda.appendChild(textoCelda);
            fila.appendChild(celda);

            var celda = document.createElement("td");
            let img = document.createElement("img");
            img.setAttribute("src", datos[i].image)
            img.width = 50; img.height = 50;
            //var textoCelda = document.createTextNode(datos[i].name);
            celda.appendChild(img);
            fila.appendChild(celda);


            // agrega la fila al final de la tabla (al final del elemento tblbody)
            tblBody.appendChild(fila);
        }

        // posiciona el <tbody> debajo del elemento <table>
        tabla.appendChild(tblBody);
        // appends <table> into <body>
        capa.appendChild(tabla);
        // modifica el atributo "border" de la tabla y lo fija a "2";
        tabla.setAttribute("border", "2");
        //  tabla.border=2;
    } else {
        alert("La tabla ya existe.");
    }
}

function borrarTabla() {
    let latabla = document.getElementById("latabla");
    if (latabla === null) {
        alert("No hay tabla que borrar.");
    } else {

        latabla.parentNode.removeChild(latabla);

    }
}


function resaltarPares() {
    let tabla = document.getElementById("latabla");

    if (!(tabla === null)) {
        let filas = tabla.getElementsByTagName('tr');

        for (let i = 1; i < filas.length; i += 2) {
            filas[i].classList.add('pares');
        }
    }
}

function resaltarImpares() {
    let tabla = document.getElementById("latabla");

    if (!(tabla === null)) {
        let filas = tabla.getElementsByTagName('tr');

        for (let i = 0; i < filas.length; i += 2) {
            filas[i].classList.add('impares');
        }
    }
}

function borrarClases() {
    let tabla = document.getElementById("latabla");

    if (tabla == null || tabla == undefined) {
        alert("Y Dijo Yoda: No Resaltar Poder Impares");
        return;
    }
    let filas = tabla.getElementsByTagName("tr");
    for (let fila of filas) {
        fila.classList.remove("pares", "impares");
    }
}

function cambiarEspecies() {
    let tabla = document.getElementById("latabla");

    if (tabla == null || tabla == undefined) {
        alert("Y Dijo Yoda: No Cambiar Poder Especies");
        return;
    }

    let especieAntigua = prompt("Introduzca Especia a Modificar", "Human");
    let especieNueva = prompt("Introduzca Nueva Especie ", "Alien");
    filas = tabla.querySelectorAll("tr[especie=" + especieAntigua + "]");
    filas.forEach(fila => {
        fila.setAttribute("especie", especieNueva);
        celdas = fila.getElementsByTagName("td");
        let texto = document.createTextNode(especieNueva);
        if (celdas[1].hasChildNodes())
            celdas[1].removeChild(celdas[1].lastChild);
        celdas[1].appendChild(texto);

    });
}

function eliminarMasculinos() {
    let tabla = document.getElementById("latabla");

    if (tabla == null || tabla == undefined) {
        alert("Y Dijo Yoda: No Eliminar Poder Masculinos");
        return;
    }

    let filas = document.getElementsByTagName("tr");
    
    Array.from(filas).forEach (fila => {
        let celdas = fila.getElementsByTagName('td');
        if (celdas.length > 0 && celdas[2].hasChildNodes && celdas[2].textContent == 'Male') {
            fila.parentNode.removeChild(fila);
        }
    })
}

