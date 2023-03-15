let b_guardar = document.getElementById("b_guardar");


b_guardar.onclick = function(e) {
  e.preventDefault();
  //const datos = new FormData(document.getElementById('formulario'));
  const formInsercion = document.getElementById("f_actualizar");
  const datos = new FormData(formInsercion);


  const myInit = {
    method: "POST", //GET POST PUT DELETE etc..
    mode: "cors",
    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
    body: datos,
  };
  let peticion = new Request("views/piezas/store.php?evento=editar&ajax=true", myInit);

  //NOTACION COMPRIMIDA
  fetch(peticion)
    .then((resp) => resp.json())
    .then(function(datos) {
        console.log(datos);
//limpiar capas
        let capasErrores=document.querySelectorAll(".errores");
        capasErrores.forEach(function(capa) {
            capa.innerHTML="";
            capa.classList.remove("visible");
            capa.classList.add("invisible");
          });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        // y vuestra tarea es dibujar los errores.
        if (datos.ok==false){
            console.log(datos.errores);
            //esto es jquery con js seria
            //capasErrores.forEach(function(capa,indice) {
            $.each(datos.errores, function(index, errores) {
                          
                let capaError=document.getElementById("e_"+index);
                let mensaje="";
                for  (let i=0;i<errores.length;i++){
                    mensaje+= errores[i];
                }
                capaError.innerHTML=mensaje;
                capaError.classList.remove("invisible");
                capaError.classList.add("visible");
                // tu iterador
            });

            
            Toast.fire({
                icon: 'error',
                title: 'No se ha podido insertar.',
                text: 'Montar sistema de Mensajes largo esto solo es una cadena'
                });
            
        }
        else{
            document.getElementById("idOriginal").value=document.getElementById("numpieza").value
            //$("#idOriginal").val($("#numpieza").val());
            Toast.fire({
                icon: 'success',
                title: 'Insercion Ejecutada con Éxito.',
                text: 'Mensaje largo',
                });
            }
    })
    .catch(function(error) {
        console.log(error);
    });
};


