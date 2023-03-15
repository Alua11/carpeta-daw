let casillaX = 4;
function calculaCasilla(cambioCasilla) {
    let nextCasilla = casillaX + cambioCasilla;
    if (nextCasilla < 0) {
        nextCasilla = nextCasilla + 9;
    }
    if (nextCasilla > 8) {
        nextCasilla = nextCasilla - 9;
    }
    console.log(nextCasilla);
    return nextCasilla;
}
function pintaCasillas(casillaOrigen, casillaDestino){
    let objCasillaOrigen = document.getElementById('casilla' + casillaOrigen);
    let objCasillaDestino = document.getElementById('casilla' + casillaDestino);
    let numeroCasillaDestino = objCasillaDestino.innerHTML; 
    objCasillaDestino.innerHTML = 'X';
    objCasillaOrigen.innerHTML = numeroCasillaDestino;
}
function Subir() {
    let viejaCasillaX = casillaX;
    casillaX = calculaCasilla(-3); 
    pintaCasillas(viejaCasillaX, casillaX);
}
function Bajar() {
    let viejaCasillaX = casillaX;
    casillaX = calculaCasilla(+3); 
    pintaCasillas(viejaCasillaX, casillaX);
}
function Izq() {
    let viejaCasillaX = casillaX;
    casillaX = calculaCasilla(-1); 
    pintaCasillas(viejaCasillaX, casillaX);
}
function Derecha() {
    let viejaCasillaX = casillaX;
    casillaX = calculaCasilla(+1); 
    pintaCasillas(viejaCasillaX, casillaX);
}