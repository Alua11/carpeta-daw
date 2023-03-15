<!-- 8) Búsqueda del tesoro. Teniendo un tablero de tamaño definido por el usuario, donde está
escondido el tesoro, tenemos 5 intentos para encontrar el tesoro.
PREGUNTAR COMO HACERLO VISUALMENTE PUES HAY VARIAS OPCIONES -->
<?php
if (!isset($_REQUEST["numero"]) && (!isset($_REQUEST["numero2"]))) {
?>

    <form action="funciones.php" method="post">
        Introduzca el primer numero mayor que entre 2 y 10 <input type="text" name="numero" id="numero" value=""><br>
        Introduzca el segundo numero entre 3 y 10<input type="text" name="numero2" id="numero2" value=""><br>

        <input type="submit" value="Enviar">
    </form>
<?php
}

if (isset($_REQUEST["datos"])) {
    echo $_REQUEST["datos"];
}
