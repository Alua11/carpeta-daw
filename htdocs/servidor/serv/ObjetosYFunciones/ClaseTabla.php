<html>

<head>
    <title>Pruebas</title>
</head>

<body>
    <?php

    class Celda
    {
        private $texto;
        private $colorFuente;
        private $colorFondo;

        public function __construct(string $txt, string $cFu="black", string $cFo="white")
        {
            $this->texto = $txt;
            $this->colorFuente = $cFu;
            $this->colorFondo = $cFo;
        }

        public function setTexto(string $txt)
        {
            $this->texto = $txt;
        }
        public function setColorFuente(string $cFu)
        {
            $this->colorFuente = $cFu;
        }
        public function setColorFondo(string $cFo)
        {
            $this->colorFondo = $cFo;
        }

        public function getTexto(): string
        {
            return $this->texto;
        }
        public function getColorFuente(): string
        {
            return $this->colorFuente;
        }
        public function getColorFondo(): string
        {
            return $this->colorFondo;
        }

        public function mostrar() {
            echo "<td style='color:" . $this->colorFuente . " backgraund-color:" . $this->colorFondo . "'>" . $this->texto . "</td>";
        }
    }

    class Tabla
    {
        private $mat = array();
        private $cantFilas;
        private $cantColumnas;
        public function __construct($fi, $co)
        {
            $this->cantFilas = $fi;
            $this->cantColumnas = $co;
        }
        public function cargar(int $fila, int $columna, Celda $celda)
        {
            $this->mat[$fila][$columna] = $celda;
        }
        private function inicioTabla()
        {
            echo '<table border="1">';
        }
        private function inicioFila()
        {
            echo '<tr>';
        }
        private function mostrarCelda($fi, $co)
        {
            $this->mat[$fi][$co]->mostrar();
        }
        private function finFila()
        {
            echo '</tr>';
        }
        private function finTabla()
        {
            echo '</table>';
        }
        public function mostrar()
        {
            $this->inicioTabla();
            for ($f = 1; $f <= $this->cantFilas; $f++) {
                $this->inicioFila();
                for ($c = 1; $c <= $this->cantColumnas; $c++) {
                    $this->mostrarCelda($f, $c);
                }
                $this->finFila();
            }
            $this->finTabla();
        }
    }


    $tabla1 = new Tabla(2, 3);
    $celda1 = new Celda("1-1");
    $celda2 = new Celda("1-2");
    $celda3 = new Celda("1-3");
    $celda4 = new Celda("hola");
    $celda5 = new Celda("hola");
    $celda6 = new Celda("hola");
    $tabla1->cargar(1, 1, $celda1);
    $tabla1->cargar(1, 2, $celda2);
    $tabla1->cargar(1, 3, $celda3);
    $tabla1->cargar(2, 1, $celda4);
    $tabla1->cargar(2, 2, $celda5);
    $tabla1->cargar(2, 3, $celda6);
    $tabla1->mostrar();


    ?>
</body>

</html>