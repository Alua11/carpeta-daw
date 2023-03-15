<?php
require_once "assets/php/funciones.php";
$cadenaErrores = "";
$cadena = "";
$errores = [];
$datos = [];
$visibilidad = "invisible";
if (isset($_REQUEST["error"])) {
  $errores = ($_SESSION["errores"]) ?? [];
  $datos = ($_SESSION["datos"]) ?? [];
  $cadena = "Atención se han producido errores";
  $visibilidad = "visible";
}
?>
<div class="w-75" style="margin: 0 auto">

  <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
  <form action="index.php?accion=guardar&evento=crear&tabla=producto" method="POST">
    
    <div class="form-group">
      <label for="nomproducto">Nombre</label>
      <input required type="text" class="form-control mb-4" id="nomproducto" name="nomproducto" placeholder="Introduce el Nombre" value="<?= $_SESSION["datos"]["nompieza"] ?? "" ?>">
      <?= isset($errores["nompieza"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "nompieza") . '</div>' : ""; ?>
    </div>
    
    <div class="form-group">
      <label for="precio">Precio</label>
    <input required type="number" min="0" step="any" pattern="^[0-9]+[.,]?([0-9]{0,2})$" class="form-control mb-4" id="precio" name="precio" placeholder="Introduce el Precio" value="<?= $_SESSION["datos"]["preciovent"] ?? "" ?>">
    <?= isset($errores["precio"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "precio") . '</div>' : ""; ?>
    </div>

    <div class="form-group">
      <label for="genero">Genero</label>
    <input required type="text" class="form-control mb-4" id="genero" name="genero" placeholder="Introduce el Genero" value="<?= $_SESSION["datos"]["preciovent"] ?? "" ?>">
  </div>

  <select required onchange="mostrarInputs(this)" class="form-select mb-4" aria-label="Default select example" name="tipo">
    <option selected>Escoge tipo de producto</option>
    <option value="juego">Juego</option>
    <option value="CD">CD</option>
    <option value="pelicula">Pelicula</option>
  </select>

  <div id="borrarDentro">
    <div id="inputsNuevos"></div>
  </div>

  <button type="submit" class="btn btn-primary">Guardar</button>
  <a class="btn btn-danger" href="index.php">Cancelar</a>
</form>
</div>

<script>
  const mostrarInputs = (seleccion) => {
    const borrarDentro = document.getElementById("borrarDentro");
    let divInputs = document.getElementById("inputsNuevos");
    divInputs.remove();
    divInputs = document.createElement("div");
    divInputs.setAttribute("id","inputsNuevos");
    borrarDentro.appendChild(divInputs);

    let div;
    let label;
    let input;

    switch(seleccion.value) {
      case "juego": 
        div = document.createElement("div");
        div.setAttribute("class","form-group mb-4");
        divInputs.appendChild(div);

        label = document.createElement("label");
        label.setAttribute("for","tipo");
        label.innerHTML = "Plataforma";
        div.appendChild(label);

        let select = document.createElement("select");
        select.setAttribute("class","form-select mb-4");
        select.setAttribute("aria-label","Default select example");
        select.setAttribute("name","plataforma");
        div.appendChild(select);

        let option1 = document.createElement("option");
        option1.innerHTML = "Nintendo";
        option1.setAttribute("value","nintendo");
        select.appendChild(option1);

        let option2 = document.createElement("option");
        option2.innerHTML = "Xbox";
        option2.setAttribute("value","xbox");
        select.appendChild(option2);

        let option3 = document.createElement("option");
        option3.innerHTML = "PlayStation";
        option3.setAttribute("value","playstation");
        select.appendChild(option3);
        break;
      
      case "CD":
        div = document.createElement("div");
        div.setAttribute("class","form-group mb-4");
        divInputs.appendChild(div);

        label = document.createElement("label");
        label.setAttribute("for","idioma");
        label.innerHTML = "Idioma";
        div.appendChild(label);

        input = document.createElement("input");
        input.setAttribute("class","form-control mb-4");
        input.setAttribute("id","idioma");
        input.setAttribute("name","idioma");
        input.setAttribute("type","text");
        div.appendChild(input);

        div = document.createElement("div");
        div.setAttribute("class","form-group mb-4");
        divInputs.appendChild(div);

        break;

      case "pelicula":
        div = document.createElement("div");
        div.setAttribute("class","form-group mb-4");
        divInputs.appendChild(div);

        label = document.createElement("label");
        label.setAttribute("for","duracion");
        label.innerHTML = "Duracion";
        div.appendChild(label);

        input = document.createElement("input");
        input.setAttribute("class","form-control mb-4");
        input.setAttribute("id","duracion");
        input.setAttribute("name","duracion");
        input.setAttribute("type","number");
        div.appendChild(input);

        div = document.createElement("div");
        div.setAttribute("class","form-group mb-4");
        divInputs.appendChild(div);

        break;
    }
  }
</script>