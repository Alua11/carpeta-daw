function getHijos(){
    console.log(document.getElementById("contenido").children);
    document.getElementById("cantidadHijos").innerHTML = document.getElementById("contenido").children.length;

}
function borrarHijos(){
    let elems = document.getElementById("contenido");
    let elemsOriginalLength = elems.children.length; 
    for(let i = 0; i< elemsOriginalLength; i++){
        let child = elems.children[i];
        if(child.tagName == "P"){
            elems.removeChild(child);
            i--; 
            elemsOriginalLength--; 
        }
    }
    getHijos(); 
}