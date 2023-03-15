<?php

####
## Eliminar un pdf
####
if (isset($_GET['eliminar'])) {
    $archivo = $_GET['eliminar'];
    $directorio = dirname(__FILE__) . "/pdf/";
    if (unlink($directorio . '/' . $archivo)) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?accion=eliminado");
        exit;
    }
}

##
## RECIBIR FORMULARIO
## Aqui pueden ir los campos que uno quiera
##


if (isset($_POST['submit'])) { // comprobamos que se ha enviado el formulario

    // comprobar que han seleccionado una pdf
    if ($_FILES['pdf']['name'] != "") { // El campo pdf contiene un pdf...

        // Primero, hay que validar que se trata de un PDF
        $allowedExts = array("pdf","PDF");
        $extension = explode(".", $_FILES["pdf"]["name"]);
        $extension = end($extension);
        if (($_FILES["pdf"]["size"] <= 1000000)) {
        if (($_FILES["pdf"]["type"] == "application/pdf") && in_array($extension, $allowedExts)) {
            // el archivo es un PDF, entonces...
            $pdf = $_FILES["pdf"]["name"];
            $directorio = dirname(__FILE__) . "/pdf/"; // directorio de tu elección

            // almacenar pdf en el servidor
            move_uploaded_file($_FILES['pdf']['tmp_name'], $directorio . '/' . $pdf);
        } else { // El archivo no es PDF
            $malformato = $_FILES["pdf"]["type"];
            header("Location: " . $_SERVER['PHP_SELF'] . "?error=noFormato&formato=$malformato");
            exit;
        }
    } else {
            header("Location: " . $_SERVER['PHP_SELF'] . "?error=PDF demasiado grande");
    }
    } else { // El campo pdf NO contiene un PDF
        header("Location: " . $_SERVER['PHP_SELF'] . "?error=noPDF");
        exit;
    }
} // fin del submit

####
## Función para redimencionar las imágenes
## utilizando las liberías de GD de PHP
####

function resizeImagen($ruta, $nombre, $alto, $ancho, $nombreN, $extension)
{
    $rutaImagenOriginal = $ruta . $nombre;
    if ($extension == 'GIF' || $extension == 'gif') {
        $img_original = imagecreatefromgif($rutaImagenOriginal);
    }
    if ($extension == 'jpg' || $extension == 'JPG') {
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);
    }
    if ($extension == 'png' || $extension == 'PNG') {
        $img_original = imagecreatefrompng($rutaImagenOriginal);
    }
    $max_ancho = $ancho;
    $max_alto = $alto;
    list($ancho, $alto) = getimagesize($rutaImagenOriginal);
    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;
    if (($ancho <= $max_ancho) && ($alto <= $max_alto)) { //Si ancho 
        $ancho_final = $ancho;
        $alto_final = $alto;
    } elseif (($x_ratio * $alto) < $max_alto) {
        $alto_final = ceil($x_ratio * $alto);
        $ancho_final = $max_ancho;
    } else {
        $ancho_final = ceil($y_ratio * $ancho);
        $alto_final = $max_alto;
    }
    $tmp = imagecreatetruecolor($ancho_final, $alto_final);
    imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);
    imagedestroy($img_original);
    $calidad = 70;
    imagejpeg($tmp, $ruta . $nombreN, $calidad);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cargar imagen</title>
    <meta name="author" content="Fernando Magrosoto V." />
    <meta name="history" content="01 noviembre 2012" />
    <meta name="email" content="fmagrosoto@gmail.com" />

    <style>
        body {
            background-color: rgb(250, 250, 250);
            color: rgb(50, 50, 50);
            font-family: sans-serif;
            font-size: 100%;
            width: 600px;
            margin: auto;
        }

        :focus {
            outline: none;
        }

        a {
            text-decoration: none;
            color: red;
        }

        a:hover {
            text-decoration: underline;
        }

        header {
            border-bottom: 1px gray dotted;
            padding-bottom: 25px;
            margin-bottom: 25px;
        }

        header h1 {
            font-size: xx-large;
            text-shadow: 1px 1px 5px gray;
        }

        header em {
            color: gray;
        }

        section form {
            font-size: small;
        }

        section form fieldset {
            padding: 10px 25px;
            background-color: white;
            border: 1px gray solid;
            border-radius: .5em;
        }

        section form fieldset legend {
            padding: 5px 10px;
            border: 1px gray solid;
            border-radius: .5em;
        }

        footer {
            border-top: 1px gray dotted;
            padding-top: 25px;
            margin-top: 25px;
            position: relative;
        }

        .msg {
            margin-bottom: 20px;
            padding: 10px;
            background-color: rgb(255, 250, 250);
            border: 1px red dotted;
        }

        .elimina {
            color: blue;
        }
    </style>

</head>

<!-- Página demostrativa que permite reducir las imágenes cargadas -->
<!-- desde un formulario y almacenarlas en el servidor -->
<!-- utilizando las librerías GD de PHP.  -->
<!-- CREADO POR: Fernando Magrosoto V. -->
<!-- HISTORIA: Noviembre 2012 -->
<!-- CONTACTO: fmagrosoto@gmail.com -->
<!-- DESCARGAR CÓDIGO: https://gist.github.com/4687238 -->

<body>
    <!-- HEADER -->
    <header>
        <h1>Script para cargar PDFs para entradas a un blog</h1>
        <em>Script para subir PDFs, y eliminar la versión original.
            Validando que sean únicamente PDF.</em>
    </header>

    <!-- SECCION -->
    <section>
        <?= isset($_GET["error"]) ? ($_GET["error"]) : ""; ?>
        <?= ($_GET["error"]) ?? ""; ?>
        <?php if (isset($_POST['submit'])) { ?>
            <div class="msg">El archivo ha sido cargado satisfactoriamente.</div>
        <?php } ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Seleccionar una imagen</legend>
                <div><input type="file" name="pdf" /></div>
                <div style="margin-top: 10px;"><input type="submit" name="submit" />
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Reiniciar</a>
                </div>
            </fieldset>
        </form>

        <div style="margin-top: 25px; font-size: small;">
            <?php
            $path = dirname(__FILE__) . "/pdf";
            $directorio = dir($path);
            echo "Directorio de pdfs: <em>" . $path . ":</em><br />
                    <span style='color: rgb(150,150,150);'>// Únicamente muestra PDF.</span><br /><br />";

            while ($archivo = $directorio->read()) {
                $extension = explode('.', $archivo);
                $extension = end($extension);
                if (
                    $extension == 'pdf'
                    || $extension == 'PDF'
                ) {
                    echo "<a href='pdf/" . $archivo . "' target='_blank'>" . $archivo . "</a> [ <a class='elimina' href='" . $_SERVER['PHP_SELF'] . "?eliminar=" . $archivo . "'>eliminar</a> ]<br>";
                }
            }
            $directorio->close();
            ?>
        </div>

    </section>
    <!-- FOOTER -->
    <footer>
        <p>&copy; 2012 - Fernando Magrosoto Vásquez</p>
        <div style="position: absolute; top: 25px; right: 0;"><a href="http://www.w3.org/html/logo/">
                <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" width="165" height="64" alt="HTML5 Powered with CSS3 / Styling, and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics">
            </a>
        </div>
    </footer>

    <!-- FIN DE LA PÁGINA -->
    <!-- EOF -->
</body>

</html>