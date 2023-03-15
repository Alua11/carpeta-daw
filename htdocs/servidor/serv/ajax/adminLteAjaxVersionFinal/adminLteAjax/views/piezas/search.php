<form id="f_buscar">
<div class="form-group">
    <select class="form-control" name="campo" id="campo">
      <option value="numpieza"  >Nº Pieza</option>
      <option value="nompieza"  >Nombre Pieza</option>
      <option value="preciovent" >Precio</option>
    </select>
    <select class="form-control" name="metodoBusqueda" id="metodoBusqueda">
      <option value="empieza" > Empieza Por</option>
      <option value="acaba"  > Acaba En </option>
      <option value="contiene" > Contiene </option>
      <option value="igual" > Es Igual A</option>
      
    </select>
  </div>
  <input type="text"  class="form-control" id="busqueda" name="busqueda"
    value="" placeholder="texto a Buscar">
    <button id="filtrar" type="button" class="btn btn-success filtrar" name="filtrar">Buscar</button>
    <button  id="todos" type="button" name="todos" class="btn btn-info filtrar" name="Todos" >Ver todos</button> 
</form>


<div id="datos"></div>



