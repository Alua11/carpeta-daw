$(function () {
  //aquellos elementos que tengan la clase eliminar
  //eliminan
  $("#datos").on("click", '.borrar', eliminarPieza);
}); // FIN DE CARGA


function eliminarPieza() {
  //boton que lo llama y que valor tiene en el campo data-id
  let valorEliminar = this.dataset.id;
  let nombrePieza = this.dataset.name;

  const datos = new FormData();
  datos.append("id", valorEliminar);


  const myInit = {
    method: "POST", //GET POST PUT DELETE etc..
    mode: "cors",
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    body: datos,
  };
  let peticion = new Request("views/piezas/delete.php?ajax=true", myInit);

  //NOTACION COMPRIMIDA
  fetch(peticion)
    .then((resp) => resp.json())
    .then(function (datos) {
      console.log(datos);
      
      if (datos.ok == true) {
        let fila = document.querySelector("tr[data-fila='"+ valorEliminar +"']");
        let padre = fila.parentNode;
        padre.removeChild(fila);

        alert ("Borrado con extio");
      } else {

      }
    })
    .catch(function (error) {
      console.log(error);
    });
}