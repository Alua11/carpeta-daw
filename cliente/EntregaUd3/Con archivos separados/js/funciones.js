//Funcion a la que se le pasan cadenas de caracteres y te devuelve una de ellas de forma aleatoria. 1   
function cadAleatoria() {
    //Array en el que se guardaran los argumentos validos.
    let argumentosValidos = [];

    let elegida = "";

    //Se rellena el array argumentosValidos con los argumentos validos que se hayan introducido como parametros.
    for (let i = 0; i < arguments.length; i++) {
        if (typeof arguments[i] != 'string') {
            alert(`El argumento ${arguments[i]} no es una cadena de caracteres, por lo que no va a considerar.`);
        } else {
            argumentosValidos.push(arguments[i]);
        }
    }

    //Se comprueba que existan argumentos.
    if (argumentosValidos.length == 0) {
        alert('No hay argumentos validos.');
    } else { //En caso de existir, se elige uno de forma aleatoria y se almacena.
        //Con el metodo random, conseguimos un numero aleatorio entre 0 y 1, sin llegar a 1.
        //Lo multiplicamos por la longitud del array para aumentar el maximo hasta ese numero.
        //Se utiliza la funcion floor para que redondee hacia abajo el numero obtenido y conseguir asi un numero entero.
        //Elegimo floor, para que nunca sea el valor del tamaño del vector y poder acceder a una posicion.
        let num = Math.floor(Math.random() * (argumentosValidos.length));
        elegida = argumentosValidos[num];
    }
    //La cadena almacenada finalmente, es la que devuelve la funcion.
    return elegida;
}

function guardar() {
    //Se generan 5 coches con los datos requeridos. 5
    for (let i = 0; i < 5; i++) {
        //Se crea una fecha valida.
        let fecha = new Date(2000, 0, (i + 1));
        //Se crea un coche con esa fecha de matriculacion.
        let coche = new Coche(fecha, i);

        //Se almacena el coche creado en el array almacen.
        almacen[i] = coche;
    }
}

function cambiarmat() {
    for (let i = 0; i < almacen.length; i++) {
        //Si el coche tiene matricula impar, entra y se cambia la fecha de matriculacion.
        if (almacen[i].matricula % 2 != 0) {
            let fecha = new Date(1995, 2, 3);
            almacen[i].fMat = fecha;
        }
    }
}

function guardarpush(numCoches = 2)  {
    //Se generan 2 coches con los datos requeridos. 7
    let i = 0;
    while (i < numCoches) {
        //Se pide un anyo valido.
        let anyo = 0;
        do {
            anyo = prompt('Intruduce el año de matriculacion del coche');
        } while (!Number.isInteger(anyo * 1) || anyo < 1);
        //Se pide un mes valido.
        let mes = 0;
        do {
            mes = prompt('Intruduce el mes de matriculacion del coche');
        } while (!Number.isInteger(mes * 1) || (mes < 0 || mes > 11));
        //Se pide un dia valido. (No se tienen en cuenta meses de 31 dias ni los especiales de febrero, se consideraran en otras versiones.)
        let dia = 0;
        do {
            dia = prompt('Intruduce el dia de matriculacion del coche');
        } while (!Number.isInteger(dia * 1) || (dia < 0 || dia > 30));
        //Se crea una fecha con los parametros solicitados.
        let fecha = new Date(anyo, mes, dia);

        //se crea un coche con los datos requeridos.
        let coche = new Coche(fecha, almacen.length);
        //Se almacena el coche en el array.
        almacen.push(coche);

        i++;
    }
}

function mostrarEtECO() {
    //Mostrar etEco de los coches de almacen. 10
    let etiqueta = '';
    for (let coche of almacen) {
        if (coche.etEco) {
            etiqueta += ('El coche con matricula ' + coche.matricula + ' tiene como etiqueta ECO: ' + coche.etEco + '\n');
        } else {
            etiqueta += ('El coche con matricula ' + coche.matricula + ' no tiene etiqueta ECO\n');
        }
    }
    console.log(etiqueta);
}

function mostrarCombustible() {
    let combustible1 = '';
    for (let coche of almacen) {
        combustible1 += ('Combustible coche matricula ' + coche.matricula + ': ');
        for (let atributo in coche) {
            if (atributo == 'tipoCombustible') {
                combustible1 += (coche[atributo] + '\n');
            }
        }
    }
    console.log(combustible1);
}

function combustible0aGasolina() {
    //Cambiar el combustible de los coches con etEcho = '0' a 'gasolina'. 13
    for (let coche of almacen) {
        if (coche.etEco == '0') {
            coche.cambiarTipoCombustible('gasolina');
        }
    }
}