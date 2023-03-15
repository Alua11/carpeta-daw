function createNode(element) {
    return document.createElement(element);
}
function append(parent, el) {
    return parent.appendChild(el);
}
const boton = document.getElementById("mostrar");
boton.addEventListener("click", mostrarDatos);
function mostrarDatos() {
    const ul = document.getElementById("autores");
    const url = "http://acnhapi.com/v1/villagers";
    fetch(url)
        .then((resp) => resp.json())
        .then(function (info) {
            console.log(info);
            for (let indicePersonaje in info) {
                let li = createNode("li");
                let img = createNode("img");
                let span = createNode("span");
                console.log(img);
                img.src = info[indicePersonaje].image_uri;
                span.innerHTML = info[indicePersonaje].name["name-EUes"];
                append(li, img);
                append(li, span);
                append(ul, li);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}