import almacen from "./estructuras.js";
import {cadAleatoria} from "./funciones.js";

export {Coche, etiquetaECO};

//Constructor de Coches. 3 y 4
function Coche(fMat, matricula) {
    //Al crear el coche, se le pasan los valores de la fecha de matriculacion y el numero de matricula.
    //El motor, inicialmente siempre tomara el valor de 'apagado'.
    this.fMat = new Date(fMat);
    this.matricula = matricula;
    this.motor = cadAleatoria('arrancado', 'apagado');

    //Funcion que cambia el estado de motor a 'arrancado'.
    this.arrancar = function () {
        this.motor = 'arrancado';
    }
    //Funcion que cambia el estado de motor a 'apagado'.
    this.apagar = function () {
        this.motor = 'apagado';
    }
}

function etiquetaECO() {
    for (let i = 0; i < almacen.length; i++) {
        //Se crea una fecha con la fMat de cada coche.
        let fecha = new Date(almacen[i].fMat);
        //Creamos la fecha de referencia con la que queremos comparar.
        let fechaBase = new Date(2000, 0, 1);
        //Se compara cada fecha y en caso de cumplir la condicicion, crea el atributo.
        if (fecha >= fechaBase) {
            almacen[i].etEco = cadAleatoria('0', 'ECO', 'B', 'C');
        }
    }
}


//Añadir propiedad tipoCombustible al prototipo e inicializar en electrico. Valores validos: 'electrico','gasolina','diesel','hibrido' y 'gas'. 9
Coche.prototype.tipoCombustible = 'electrico';



//Metodo cambiarTipoCombustible al prototipo. Cambia el tipo de combustible del coche al del argumento que se le pasa. 12
Coche.prototype.cambiarTipoCombustible = function (cambio) {
    this.tipoCombustible = cambio;
}