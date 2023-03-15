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
    const url = "https://randomuser.me/api/?results=10";
    fetch(url)
        .then((resp) => resp.json())
        .then(function (data) {
            console.log(data);
            let authors = data.results;
            for (let author of authors) {
                let li = createNode("li");
                let img = createNode("img");
                let span = createNode("span");
                console.log(img);
                img.src = author.picture.medium;
                span.innerHTML = `${author.name.first} ${author.name.last}`;
                append(li, img);
                append(li, span);
                append(ul, li);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}