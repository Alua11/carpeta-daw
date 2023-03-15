<html>

<head>
    <title>Pruebas</title>
</head>

<body>
    <?php
    class CabeceraPagina
    {
        private $titulo;
        private $ubicacion;
        private $bgColor;
        private $fontColor;
        public function __construct($tit, $ubi = 'left', $bgCo = 'white', $fCo = 'black')
        {
            $this->titulo = $tit;
            $this->ubicacion = $ubi;
            $this->bgColor = $bgCo;
            $this->fontColor = $fCo;
        }
        public function mostrar()
        {
            echo '<div style="font-size:40px;text-align:' . $this->ubicacion . '">';
            echo $this->titulo;
            echo '</div>';
        }
    }
    $cabecera = new CabeceraPagina('El blog del programador', 'center');
    $cabecera->mostrar();
    ?>
</body>

</html>