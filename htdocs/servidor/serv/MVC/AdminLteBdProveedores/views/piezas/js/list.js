let botonInsertar = document.getElementById("insertar");
botonInsertar.onclick = function (e) {
    e.preventDefault();
    const formInsercion = document.getElementById("f_insercion");
    const datos = new FormData(formInsercion);
    const myInit = {
        method: "POST", //GET POST PUT DELETE etc..
        mode: "cors",
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        body: datos,
    };
    let peticion = new Request("views/piezas/store.php?evento=crear&ajax=true", myInit);//lo ajax se verá

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
                    title: 'No se ha podido insertar.',
                    text: 'Montar sistema de Mensajes largo esto solo es una cadena'
                });
            }
            else {
                Toast.fire({
                    icon: 'success',
                    title: 'Insercion Ejecutada con Éxito.',
                    text: 'Mensaje largo',
                });
            }
        })
        .catch(function (error) {
            console.log(error);
            alert (`Error: ${error}`);
        });
};