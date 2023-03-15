<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $aciertos = $_GET["aciertos"];
        if(is_numeric($aciertos)){
            switch($aciertos){
                case 0:
                case 1:
                case 2:
                    echo "Eres patético. A quien se le ocurre poner que gana el Barça de Van Gaal.";
                    break;
                case 3:
                case 4:
                case 5:
                    echo "Ya son ganas de tirar el dinero, inutil.";
                    break;
                case 6:
                case 7:
                case 8:
                    echo "Mi abuelo lo hace mejor, y eso que apenás tiene megahertzios.";
                    break;
                case 9:
                    echo "Mira que pena  Dos piedras.";
                    break;
                case 10:
                    echo "Presume a tus amigos, has ganados una miseria.";
                    break;
                case 11:
                    echo "Tienes pa un cubatita.";
                    break;
                case 12:
                    echo "A repartir con la peña quinieslista… te tocan dos duros.";
                    break;
                case 13:
                    echo "Dineroooooooooo";
                    break;
                case 14:
                    echo "Vamos a medias, figura.";
                    break;
                default:
                    echo "El numero no es valido.";
                    break;
            }
        } else {
            echo "{$aciertos} no es un numero";
        }
    ?>
</body>
</html>