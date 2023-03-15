<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Prueba de subir fichero</title>
</head>

<body>
    <p>
        <?php
        $rutaSubidas = "upload/";
        $msgError = array(
            0 => "No hay error, el fichero se subió con éxito",
            1 => "El tamaño del fichero supera la directiva upload_max_filesize el php.ini",
            2 => "El tamaño del fichero supera la directiva MAX_FILE_SIZE especificada en el formulario HTML",
            3 => "El fichero fue parcialmente subido",
            4 => "No se ha subido un fichero",
            6 => "No existe un directorio temporal",
            7 => "Fallo al escribir el fichero al disco",
            8 => "La subida del fichero fue detenida por la extensión"
        );
        $imgs = ["image/gif"=>"image/gif", "image/jpeg"=>"image/jpeg", "image/png"=>"image/png"];
        $pdf = ["application/pdf"=>"application/pdf"];
        $word = ["application/vnd.openxmlformats-officedocument.wordprocessingml.document"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
        $permitidos = ["imgs"=>$imgs,"pdf"=>$pdf,"word"=>$word];
        
        foreach ($_FILES as $fichero => $value) {
            if ($_FILES[$fichero]["error"] > 0) {
                echo "Error: " . $msgError[$_FILES[$fichero]["error"]] . "<br />";
                //Cambiar este elseif para que sea comodo.
            } elseif (($fichero == "imagen" && !isset($permitidos["imgs"][$_FILES[$fichero]["type"]])) || ($fichero == "pdf" && !isset($permitidos["pdf"][$_FILES[$fichero]["type"]])) || ($fichero == "word" && !isset($permitidos["word"][$_FILES[$fichero]["type"]]))) {
            } else {
                echo "Nombre original: " . $_FILES[$fichero]["name"] . "<br />";
                echo "Tipo: " . $_FILES[$fichero]["type"] . "<br />";
                echo "Tamaño: " . ceil($_FILES[$fichero]["size"] / 1024) . " Kb<br / >";
                echo "Nombre temporal: " . $_FILES[$fichero]["tmp_name"] . "<br />";

                if (!file_exists($rutaSubidas) || !is_dir($rutaSubidas)) {
                    mkdir($rutaSubidas);
                }
                if (file_exists($rutaSubidas . $_FILES[$fichero]["name"])) {
                    echo $_FILES[$fichero]["name"] . " ya existe";
                } else {
                    move_uploaded_file($_FILES[$fichero]["tmp_name"], $rutaSubidas . $_FILES[$fichero]["name"]);
                    echo "Almacenado en: " . $rutaSubidas . $_FILES[$fichero]["name"];
                }
            }
        }
        
        ?>
    </p>
</body>

</html>