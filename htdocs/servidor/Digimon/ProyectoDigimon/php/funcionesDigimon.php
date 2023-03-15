<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<?php

function mi_autoloader($clase)
{
    include_once 'Clases/' . $clase . '.php';
}

function serializar($objecto)
{
    $cadenatmp = serialize($objecto);
    $cadena = urlencode($cadenatmp);
    return $cadena;
}

function deserializar($texto)
{
    $objeto = [];
    if ($texto != "") {
        $texto = stripslashes($texto);
        $texto = urldecode($texto);
        $objeto = unserialize($texto);
    }
    return $objeto;
}

function botonInicio() {
    ?>
    <form method="post" action="index.html">
        <input type="submit" value="Volver">
    </form>
    <?php
}
//Administrar
    //Solicitar un digimon.
    function solicitarDigimon()
    {
        $tiposDigimon = ['vacuna' => 'vacuna', 'virus' => 'virus', 'animal' => 'animal', 'planta' => 'planta', 'elemental' => 'elemental'];
        ?>
        <form method='POST' action=<?= $_SERVER['PHP_SELF'] ?>>
            <label>Nombre del digimon:</label><input type='text' name='nomDigi' id='nomDigi' value=<?= ($_POST['nomDigi']) ?? ''; ?>><br>
            <label>Ataque:</label><input type='number' name='ataque' id='ataque' value=<?= ($_POST['ataque']) ?? ''; ?>><br>
            <label>Defensa:</label><input type='number' name='defensa' id='defensa' value=<?= ($_POST['defensa']) ?? ''; ?>><br>
            <label>Selecionar tipo:</label><select name='tipo' id='tipo'>
                <?php
                foreach ($tiposDigimon as $tipo) {
                    echo "<option value={$tipo}>" . ucfirst($tipo) . "</option>";
                }
                ?>
            </select><br>
            <label>Selecionar nivel:</label><select name='nivel' id='nivel'>
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    echo "<option value={$i}>Nivel {$i}</option>";
                }
                ?>
            </select><br>
            <input type="submit" name='crearDigi' id='crearDigi' value="Crear Digimon">
        </form>
        <?php
    }

    //Solicitar un usu.
    function solicitarUsu()
    {
    ?>
        <form method='POST' action=<?= $_SERVER['PHP_SELF'] ?>>
            <label>Nombre:</label><input type='text' name='nomUsu' id='nomUsu' value=<?= ($_POST['nomUsu']) ?? ''; ?>><br>
            <label>Contraseña:</label><input type='password' name='pass' id='pass'><br>
            <input type="submit" name='crearUsu' id='crearUsu' value="Crear">
        </form>
    <?php
    }

    //Formulario para pedir editar un digimon
    function botonEditar(string $n)
    {
        ?>
        <form method="POST" action="imagen_digimon.php">
            <input type="hidden" name="digimon" value=<?= $n ?>>
            <input type="submit" name="modificar" id="modificar" value="Modificar imagen">
        </form>
        <?php
    }

    //Formulario para pedir las imagenes a las que se quiere cambiar.
    function formularioCambiarImagen()
    {
        ?>
        <form action=<?= $_SERVER['PHP_SELF'] ?> method="POST" enctype="multipart/form-data">
            <label>Imagen por defecto: </label><input type="file" name="default" id="default"><br>
            <label>Imagen de victoria: </label><input type="file" name="victoria" id="victoria"><br>
            <label>Imagen de derrota: </label><input type="file" name="derrota" id="derrota"><br>
            <input type="hidden" name="digimon" value=<?= $_POST['digimon']?>>
            <input type="submit" name="subir" id="subir" value="Subir imagenes">
        </form>
        <?php
    }

    //Funcion para comprobar que el archivo subido tiene el formato correcto.
    function formatoImagenCorrecto($foto):bool {
        $allowedExts = array("png");
        $extension = explode(".", $_FILES[$foto]["name"]);
        $extension = end($extension);
        if (($_FILES[$foto]["type"] == "image/png") && in_array($extension, $allowedExts)) return true;
        return false;
    }

    //Subir la imagen a la ubicacion correcta
    function guardarImagen($nombreDigi, $f) {
        $extension = explode(".", $_FILES[$f]["name"]);
        $extension = end($extension);

        $directorio = str_replace('\php', '', dirname(__FILE__)) . "\Digimons/" . $nombreDigi; // directorio de tu elección

        // almacenar imagen en el servidor
        move_uploaded_file($_FILES[$f]['tmp_name'], $directorio . '/' . $f . ".png");
    }

    function volverAdmin() {
        ?>
        <form method="post" action="admin.php">
            <input type="submit" value="Volver">
        </form>
        <?php
    }

//Funciones Usuario
    function inicioPaginasUsuario() {
        session_start();

        if (isset($_POST['cerrarSesion'])) {
            $_SESSION = [];
            session_destroy();
        }

        if (!isset($_SESSION['nombre'])) {
            header("location:login.php");
            exit;
        }
    }
    function botonCerrarSesion() {
        ?>
        <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?>>
            <input type="submit" name="cerrarSesion" id="cerrarSesion" value="Cerrar sesion">
        </form>
        <?php
    }
    function botonInicioUsuario() {
        ?>
        <form method="POST" action="inicio_usuario.php">
            <input type="submit" value="Inicio">
        </form>
        <?php
    }
    function formularioInicioUsuario() {
        ?>
        <form method="POST" action="ver_mis_digimon.php">
            <input type="submit" name="verMisDigimon" id="verMisDigimon" value="Ver Mis Digimon">
        </form>
        <form method="POST" action="organizar_equipo.php">
            <input type="submit" name="organizarEquipo" id="organizarEquipo" value="Organizar Equipo">
        </form>
        <form method="POST" action="jugar_partida.php">
            <input type="submit" name="jugarPartida" id="jugarPartida" value="Jugar Partida">
        </form>
        <form method="POST" action="digievolucionar.php">
            <input type="submit" name="digievolucionar" id="digievolucionar" value="Digievolucionar">
        </form>
        <?php
    }
