$(function () {
  //aquellos elementos que tengan la clase eliminar
  //eliminan
  $("#f_buscar").on("click",'.filtrar', filtrar );
  $("#datos").on("click", '.borrar', eliminarPieza);
}); // FIN DE CARGA


function filtrar(e){
  e.preventDefault();
  let datos = new FormData();
  let url="views/piezas/filtrarAjax.php?ajax=true&evento=todos";

  if (this.id=="filtrar"){
    const fBuscar = document.getElementById("f_buscar");
    datos = new FormData(fBuscar);
    url="views/piezas/filtrarAjax.php?ajax=true&evento=filtrar";
  }
  const myInit = {
    method: "POST", //GET POST PUT DELETE etc..
    mode: "cors",
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    body: datos,
  };
   let peticion = new Request(url, myInit);
    //NOTACION COMPRIMIDA
    fetch(peticion)
    .then((resp) => resp.json())
    .then(function(respuesta) {
        console.log(respuesta);
        if (respuesta.ok==true){
          DibujarTabla(respuesta.datos);
        }
        else{

        }
//limpiar capas
      })
    .catch(function(error) {
        console.log(error);
    });
}

function DibujarTabla(datos){
  let contenidoTabla=document.getElementById("datos");
  let tabla="<table id='datos' class='table table table-hover'>"+
  "<thead class='table-dark'>"+
      "<tr>"+
        "<th scope='col'>Numero de Pieza</th>"+
        "<th scope='col'>Nombre de Pieza</th>"+
        "<th scope='col'>Precio </th>"+
        "<th>Borrar Ajax</th><th>Editar</th>"+
        "</tr>"+
    "</thead>"+
    "<tbody>" ;

    for (let i=0;i<datos.length;i++){
      let activo="";
      if (datos[i].borrable==false) activo="disabled";
      let botonEliminar="<a class='borrar btn btn-danger  "+activo+"'  data-id='"+datos[i].numpieza+"' data-name='"+ datos[i].nompieza+"'><i class='fa fa-trash'></i> Borrar</a>";

      tabla+= "<tr data-fila='"+datos[i].numpieza+"'>"+
        "<td>"+datos[i].numpieza+"</td>"+
        "<td>"+datos[i].nompieza+"</td>"+
        "<td>"+datos[i].preciovent+"</td>"+
        "<td>"+botonEliminar+"</td>"+
        "<td><a class='btn btn-success' href='index.php?accion=editar&tabla=piezas&id="+datos[i].numpieza+"'> <i class='fas  fa-paint-brush'></i> Editar</a></td>"+
        "<tr>";
    }
    tabla+="</tbody> </table>";
    contenidoTabla.innerHTML=tabla;
}

function eliminarPieza() {
  //boton que lo llama y que valor tiene en el campo data-id
  let valorEliminar = this.dataset.id;
  let nombrePieza = this.dataset.id;
  Swal.fire({
    title: 'Estas seguro que quieres borrar la pieza: ' + valorEliminar + ' - ' + nombrePieza + '?',
    showDenyButton: true,
    confirmButtonText: 'Borrar',
    denyButtonText: 'Cancelar',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isDenied) {
      Swal.fire('No se borrará la pieza ', '', 'info')
      return false;
    }
    else if (result.isConfirmed) {
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

          let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
          // y vuestra tarea es dibujar los errores.
          if (datos.ok == false) {
            Toast.fire({
              icon: 'error',
              title: 'No se ha podido Borrar.',
              text: 'No se ha podido borrar ' + valorEliminar + " " + nombrePieza,
            });
          }
          else {
            //($('tr[data-fila='+valorEliminar+']').remove());
            let elemento = document.querySelector('tr[data-fila="' + valorEliminar + '"]');
            elemento.parentNode.removeChild(elemento);
            Toast.fire({
              icon: 'success',
              title: 'Borrado Ejecutada con Ã‰xito.',
              text: 'Se ha podido borrar la pieza ' + valorEliminar + " " + nombrePieza,
            });
          }

        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });
}