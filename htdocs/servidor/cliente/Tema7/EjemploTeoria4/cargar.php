<html>

<head>
</head>

<body>
    <h2>PROVINCIAS Y POBLACIONES</h2>
    <p>Elije una provincia y verás sus poblaciones</p>
    <form action="siguiente.php" id="formulario">
        Provincia:
        <select id='provincia' name='provincia'>
            <option value="0">Elije provincia</option>
            <?php
            include('cargar_provincias.php');
            ?>
        </select>
        <div id='pepin'>Aqui Van las poblaciones </div>
        <input type='submit' value='Siguiente' />
    </form>
    <script type="text/javascript">
        let desplegable = document.getElementById('provincia');
        let pepin = document.getElementById('pepin');
        desplegable.onchange = function(e) {
            e.preventDefault();
            let provincia = this.value;
            CargarPoblacion(provincia); //AQUÍ ESTÁ LA GRACIA
        };

        function CargarPoblacion(provincia) {
            let myInit = {
                method: 'GET', //GET POST PUT DELETE etc..
                mode: 'cors', //Permite peticiones cruzadas, a mi servidor y fuera de mi servidor
                cache: 'no-cache', // *default, no-cache, reload, forcecache, only-if-cached
            };
            let peticion = new Request('cargar_poblacion.php?provincia=' + provincia, myInit);

            /*
            NOTACION COMPRIMIDA
            fetch(peticion)
            .then(respuesta=>respuesta.text())
            .then(texto=>(pepin.innerHTML=texto))
            .catch(function(error) {
                pepin.innerHTML = "";
                let p = document.createElement('p');
                p.appendChild( document.createTextNode('Error: ' + error.message) );
                pepin.appendChild(p);
            });*/

            fetch(peticion)
                .then(function(respuesta) {
                    if (!respuesta.ok) {
                        throw new Error("HTTP error, status = " + respuesta.status);
                    }
                    return respuesta.text();
                })
                .then(function(texto) {
                    pepin.innerHTML = texto;
                })
                .catch(function(error) {
                    let p = document.createElement('p');
                    pepin.innerHTML = "";
                    p.appendChild(
                        document.createTextNode('Error: ' + error.message)
                    );
                    pepin.appendChild(p);
                });
        }
    </script>
</body>

</html>