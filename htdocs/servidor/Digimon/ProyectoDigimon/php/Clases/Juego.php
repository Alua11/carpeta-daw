<?php
class Juego
{
    private $usus;
    private $digimons;

    public function __construct()
    {
        $fUsus = file_get_contents('../usus.txt', FILE_USE_INCLUDE_PATH);
        $this->usus = deserializar($fUsus);

        $fDigis = file_get_contents('../digimons.txt', FILE_USE_INCLUDE_PATH);
        $this->digimons = deserializar($fDigis);
    }

    public function __toString()
    {
        $cadena = '';
        foreach ($this->usus as $usu) {
            $cadena .= $usu . "<br>";
        }
        foreach ($this->digimons as $digimon) {
            $cadena .= $digimon . "<br>";
        }
        return $cadena;
    }
    //get y set
    public function getUsus()
    {
        return $this->usus;
    }
    public function getDigimons()
    {
        return $this->digimons;
    }

    public function setUsus($us)
    {
        $this->usus = $us;
    }
    public function setDigimons($digis)
    {
        $this->digimons = $digis;
    }
//Administrar
    //Comprobar digimon correcto
    public function comprobarDigimon($n, $a, $d, $t, $lvl): string
    {
        $tiposDigimon = ['vacuna' => 'vacuna', 'virus' => 'virus', 'animal' => 'animal', 'planta' => 'planta', 'elemental' => 'elemental'];

        if (trim($n) == '') return "El nombre del digimon no puede estar vacío";

        if ($this->existeDigimon($n))  return "El digimon ya existe";

        if (!is_numeric($a)) return "El ataque no es un numero";
        $a *= 1;
        if (!is_int($a)) return "El ataque no es un numero entero";
        if ($a <= 0) return "El ataque no es un valor positivo";

        if (!is_numeric($d)) return "La defensa no es un numero";
        $d *= 1;
        if (!is_int($d)) return "La defensa no es un numero entero";
        if ($d <= 0) return "La defensa no es un valor positivo";

        if (!isset($tiposDigimon[$t])) return "El tipo no es valido";

        if (!is_numeric($lvl)) return "El nivel no es valido";
        $lvl *= 1;
        if (!is_int($lvl)) return "El nivel no es valido";
        if ($lvl < 1 || $lvl > 3) return "El nivel no es valido";

        return "";
    }

    public function existeDigimon(string $nombreDigimon): bool
    {
        return isset($this->digimons[$nombreDigimon]);
    }

    //Crear digimon
    public function crearDigimon()
    {

        solicitarDigimon();

        echo $_REQUEST['error'] ?? '';
        $resultado = "";

        if (isset($_REQUEST['crearDigi'])) {
            $n = $_REQUEST['nomDigi'];
            $n = strtolower($n);
            $a = $_REQUEST['ataque'] ?? 0;
            $d = $_REQUEST['defensa'] ?? 0;
            $t = $_REQUEST['tipo'] ?? "";
            $lvl = $_REQUEST['nivel'] ?? 0;

            $resultado = $this->comprobarDigimon($n, $a, $d, $t, $lvl);

            if ($resultado != '') {
                header("location:{$_SERVER['PHP_SELF']}?nomDigi={$n}&ataque={$a}&defensa={$d}&tipo{$t}&nivel={$lvl}&error={$resultado}");
                exit;
            }

            $digi = new Digimon($n, $a, $d, $t, $lvl);
            $this->digimons[$n] = $digi;
            $digiSerializado = serializar($this->digimons);
            $fichero = fopen('../digimons.txt', 'w', TRUE);
            fwrite($fichero, $digiSerializado);
            fclose($fichero);
            echo "Digimon creado correctamente";
        }
    }

    //Comprobar usu valido
    public function comprobarUsu($n, $p): string
    {

        if (trim($n) == '') return "El nombre no puede estar vacío";
        if (trim($p) == '') return "La contraseña no puede estar vacía";

        if (isset($this->usus[$n]))  return "El nombre {$n}, ya existe";

        return "";
    }

    //Digimons iniciales
    public function crearDigimonsIniciales(): array
    {
        $digimonsElegibles = [];
        $digimonsUsuario = [];

        foreach ($this->digimons as $claveDigimon => $digimon) {
            if ($digimon->getNivel() == 1) {
                $digimonsElegibles[$claveDigimon] = $claveDigimon;
            }
        }

        if (count($digimonsElegibles) < 3) return $digimonsUsuario;
        while (count($digimonsUsuario) < 3) {
            $digimon = array_rand($digimonsElegibles);
            if (!isset($digimonsUsuario[$digimon])) $digimonsUsuario[$digimon] = $digimon;
        }
        return $digimonsUsuario;
    }

    //Crear digimon
    public function crearUsu()
    {
        solicitarUsu();

        echo $_REQUEST['error'] ?? '';

        if (isset($_REQUEST['nomUsu'])) {
            $n = $_REQUEST['nomUsu'];
            $n = strtolower($n);
            $p = $_REQUEST['pass'] ?? 0;

            $resultado = $this->comprobarUsu($n, $p);
            $digimons = $this->crearDigimonsIniciales();

            if ($resultado != '') {
                header("location:{$_SERVER['PHP_SELF']}?&error={$resultado}");
                exit;
            }
            if ($digimons == []) {
                $resultado = 'No hay suficientes digimons para crear el usuario';
                header("location:{$_SERVER['PHP_SELF']}?nomUsu={$n}&error={$resultado}");
                exit;
            }

            $usu = new Usu($n, $p, $digimons);
            $this->usus[$n] = $usu;
            $usuSerializado = serializar($this->usus);
            $fichero = fopen('../usus.txt', 'w', TRUE);
            fwrite($fichero, $usuSerializado);
            fclose($fichero);
            echo "Usuario creado correctamente";
        }
    }

    //Crea un Array de nombres de digimons validos a los que digievolucionar
    public function digievolucionValida(string $n): array
    {
        //Array de nombres de digimons que son aptos para digievolucionar desde el digimon selecionado.
        $digimonsElegibles = [];

        $lvl1 = $this->digimons[$n]->getNivel();

        if ($lvl1 == 3) return $digimonsElegibles;

        $t1 = $this->digimons[$n]->getTipo();

        foreach ($this->digimons as $claveDigi => $digimon) {
            $lvl2 = $digimon->getNivel();
            $t2 = $digimon->getTipo();
            if ($t2 == $t1 && $lvl2 == $lvl1 + 1) $digimonsElegibles[$claveDigi] = $claveDigi;
        }
        return $digimonsElegibles;
    }

    //Crea un Array de nombres de digimons validos que pueden digievolucionar.
    public function puedenDigievolucionar(): array
    {
        $digimonsDigievolucionables = [];

        foreach ($this->digimons as $claveDigi => $digimon) {
            $lvl = $digimon->getNivel();
            if ($lvl < 3) $digimonsDigievolucionables[$claveDigi] = $claveDigi;
        }

        return $digimonsDigievolucionables;
    }

    //Definir digievolucion
    public function definirDigievolucion(string $d1, string $d2)
    {

        $this->digimons[$d1]->setDigievolucion($d2);

        $digiSerializado = serializar($this->digimons);
        $fichero = fopen('../digimons.txt', 'w', TRUE);
        fwrite($fichero, $digiSerializado);
        fclose($fichero);

        echo "Digievolucion definida correctamente";
    }

    //Pedir digievolucion
    public function pedirDigievolucion()
    {
        if (!isset($_REQUEST['digimon1'])) {
        ?>
            <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <label>Digimon que quieres que digievolucione: </label>
                <select name="digimon1" id="digimon1">
                    <?php
                    $puedenDigievolucionar = $this->puedenDigievolucionar();
                    foreach ($puedenDigievolucionar as $digimon) {
                        echo "<option value={$digimon}>{$digimon}</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="definirDigievolucion">
                <input type="submit" value="Seleccionar digimon">
            </form>
        <?php
        }
        if (isset($_REQUEST['digimon1']) && !isset($_REQUEST['digimon2'])) {
            $d1 = $_REQUEST['digimon1'];
        ?>
            <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <label>Digimon al que quieres que <?= $d1; ?> digievolucione: </label>
                <select name="digimon2" id="digimon2">
                    <?php
                    $digievolucionesValidas = $this->digievolucionValida($d1);
                    foreach ($digievolucionesValidas as $digimon) {
                        echo "<option value={$digimon}>{$digimon}</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="digimon1" value="<?= $d1; ?>">
                <input type="submit" value="Seleccionar digievolucion">
            </form>
        <?php
        }
        if (isset($_REQUEST['digimon1']) && isset($_REQUEST['digimon2'])) {
            $d1 = $_REQUEST['digimon1'];
            $d2 = $_REQUEST['digimon2'];
            $this->definirDigievolucion($d1, $d2);
            ?>
            <form method="POST" action="<?=$_SERVER['PHP_SELF'] ?>">
                <input type="submit" value="Nueva Digievolucion">
            </form>
            <?php
        }
    }

    //Mostrar digimons en una tabla, junto con un boton para editar la imagen
    public function mostrarTodosDigimons()
    {
        echo "<table><tr><th>Nombre</th><th>Ataque</th><th>Defensa</th><th>Tipo</th><th>Nivel</th><th>Digievolucion</th><th>imagen</th><th>Editar</th></tr>";
        foreach ($this->digimons as $digimon) {
            echo "<tr><td>";
            echo $digimon->getNombre();
            echo "</td>";
            echo "<td>";
            echo $digimon->getAtaque();
            echo "</td>";
            echo "<td>";
            echo $digimon->getDefensa();
            echo "</td>";
            echo "<td>";
            echo $digimon->getTipo();
            echo "</td>";
            echo "<td>";
            echo $digimon->getNivel();
            echo "</td>";
            echo "<td>";
            echo $digimon->getDigievolucion() ?: 'No digievoluciona';
            echo "</td>";
            echo "<td>";
            echo "<img src=";
            echo file_exists("../Digimons/" . $digimon->getNombre() . "/default.png") ? "../Digimons/" . $digimon->getNombre() . "/default.png" : "../Digimons/default.png";
            echo ">";
            echo "</td>";
            echo "<td>";
            botonEditar($digimon->getNombre());
            echo "</td></tr>";
        }
        echo "</table>";
    }

//Funciones usuario
    public function verMisDigimon()
    {
        $n = $_SESSION['nombre'];
        $digisUsu = $this->getUsus()[$n]->getDigimons();
        echo "<table><tr><th>Nombre</th><th>Ataque</th><th>Defensa</th><th>Tipo</th><th>Nivel</th><th>Digievolucion</th><th>imagen</th></tr>";
        foreach ($digisUsu as $nomDigi) {
            $digimon = $this->digimons[$nomDigi];
            echo "<tr><td>";
            echo $digimon->getNombre();
            echo "</td>";
            echo "<td>";
            echo $digimon->getAtaque();
            echo "</td>";
            echo "<td>";
            echo $digimon->getDefensa();
            echo "</td>";
            echo "<td>";
            echo $digimon->getTipo();
            echo "</td>";
            echo "<td>";
            echo $digimon->getNivel();
            echo "</td>";
            echo "<td>";
            echo $digimon->getDigievolucion() ?: 'No digievoluciona';
            echo "</td>";
            echo "<td>";
            echo "<img src=";
            echo file_exists("../Digimons/" . $digimon->getNombre() . "/default.png") ? "../Digimons/" . $digimon->getNombre() . "/default.png" : "../Digimons/default.png";
            echo ">";
            echo "</td></tr>";
        }
        echo "</table>";
    }

    public function elegirRival(): array
    {
        $equipoRival = [];
        if (!isset($_REQUEST['rival'])) {
        ?>
            <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?>>
                <select name="rival">
                    <?php
                    foreach ($this->usus as $nomUsu => $usuario) {
                        if ($nomUsu != $_SESSION['nombre']) echo "<option value={$nomUsu}>{$nomUsu}</option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Seleccionar Rival">
            </form>
        <?php
        } else {
            $rival = $_REQUEST['rival'];
            $equipoRival = $this->usus[$rival]->getEquipo();
        }
        return $equipoRival;
    }

    public function aleatorizarOrdenRival(): array
    {
        $inicial = $this->elegirRival();
        $final = [];
        if (count($inicial) != 0) {
            for ($i = 0; $i < 3; $i++) {
                $d = array_rand($inicial);
                $final[] = $inicial[$d];
                unset($inicial[$d]);
            }
        }
        return $final;
    }

    public function enfrentamiento(Digimon $d1, Digimon $d2): bool
    {
        $tipos = [
            'vacuna' =>
            [
                'vacuna' => 0,
                'virus' => 10,
                'animal' => 5,
                'planta' => -5,
                'elemental' => -10
            ],
            'virus' =>
            [
                'vacuna' => -10,
                'virus' => 0,
                'animal' => 10,
                'planta' => 5,
                'elemental' => -5
            ],
            'animal' =>
            [
                'vacuna' => -5,
                'virus' => -10,
                'animal' => 0,
                'planta' => 10,
                'elemental' => 5
            ],
            'planta' =>
            [
                'vacuna' => 5,
                'virus' => -5,
                'animal' => -10,
                'planta' => 0,
                'elemental' => 10
            ],
            'elemental' =>
            [
                'vacuna' => 10,
                'virus' => 5,
                'animal' => -5,
                'planta' => -10,
                'elemental' => 0
            ]
        ];
        $ataque1 = 0;
        $ataque2 = 0;
        while ($ataque1 == $ataque2) {
            $mod1 = rand(1, 20);
            $mod2 = rand(1, 20);
            $tipo1 = $d1->getTipo();
            $tipo2 = $d2->getTipo();
            $ataque1 = $d1->getAtaque() + $d1->getDefensa() + $mod1 + $tipos[$tipo1][$tipo2];
            $ataque2 = $d2->getAtaque() + $d2->getDefensa() + $mod2 + $tipos[$tipo2][$tipo1];
        }

        if ($ataque1 > $ataque2) return true;
        if ($ataque1 < $ataque2) return false;
    }

    public function combate(): array
    {
        $equipo = $this->usus[$_SESSION['nombre']]->getEquipo();
        $equipoRival = $this->aleatorizarOrdenRival();
        $resultadoFinal = ['victoria' => 0, 'derrota' => 0];
        if (count($equipoRival) == 3) {
            $i = 0;
            echo "<table><tr><th>Mi Digimon</th><th>VS</th><th>Digimon Rival</th><th>Resultado</th></tr>";
            foreach ($equipo as $nomDigi) {
                $d1 = $this->digimons[$nomDigi];
                $d2 = $this->digimons[$equipoRival[$i]];
                $resultado = $this->enfrentamiento($d1, $d2);
                $resultado ? $resultadoFinal['victoria']++ : $resultadoFinal['derrota']++;
                $nombreArchivo1 = ($resultado ? "victoria" : "derrota") . ".png";
                $nombreArchivo2 = ($resultado ? "derrota" : "victoria") . ".png";
                echo "<tr><td>{$d1->getNombre()}</td><td></td><td>{$d2->getNombre()}</td><td></td></tr>";
                echo "<tr><td><img src=";
                echo file_exists("../Digimons/" . $d1->getNombre() . "/" . $nombreArchivo1) ? "../Digimons/" . $d1->getNombre() . "/" . $nombreArchivo1 : "../Digimons/" . $nombreArchivo1;
                echo "></td><td>VS</td>";
                echo "<td><img src=";
                echo file_exists("../Digimons/" . $d2->getNombre(). "/" . $nombreArchivo2) ? "../Digimons/" . $d2->getNombre() . "/" . $nombreArchivo2 : "../Digimons/" . $nombreArchivo2;
                echo "></td><td>";
                echo $resultado ? "VICTORIA" : "DERROTA";
                echo "</td></tr>";
                $i++;
            }
            echo "</table>";
        }
        return $resultadoFinal;
    }

    public function cambiosTrasCombate(array $resultado)
    {
        $u = $this->usus[$_SESSION['nombre']];
        $u->setPJugadas($u->getPJugadas() + 1);
        if ($u->getPJugadas() % 10 == 0) $this->addDigimon();
        if ($resultado['victoria'] >= 2) {
            $u->setPGanadas($u->getPGanadas() + 1);
            if ($u->getPGanadas() % 10 == 0) $u->setTokenDigievolucion($u->getTokenDigievolucion() + 1);
        }

        $partidas = "{$u->getTokenDigievolucion()}:{$u->getPJugadas()}:{$u->getPGanadas()}";
        $fichero = fopen("../Usus/{$u->getNombre()}/partidas.txt", 'w', TRUE);
        fwrite($fichero, $partidas);
        fclose($fichero);

        $duSerializado = serializar($u->getDigimons());
        $fichero = fopen("../Usus/{$u->getNombre()}/misDigimons.txt", 'w', TRUE);
        fwrite($fichero, $duSerializado);
        fclose($fichero);

        $ususSerializado = serializar($this->usus);
        $fichero = fopen('../usus.txt', 'w', TRUE);
        fwrite($fichero, $ususSerializado);
        fclose($fichero);
    }

    public function addDigimon()
    {
        $u = $this->usus[$_SESSION['nombre']]; //Usuario con la sesion iniciada.
        $du =  $u->getDigimons(); //Nombres de los digimon del usuario.
        $dulvl1 = []; //Digimons de nivel 1 del usuario, para saber si ya los tenemos todos.
        foreach ($du as $nomDigi) {
            if ($this->digimons[$nomDigi]->getNivel() == 1) {
                $dulvl1[$nomDigi] = $nomDigi;
            }
        }
        $dlvl1 = []; //Digimons de nivel 1.
        foreach ($this->digimons as $nomDigi => $digimon) {
            if ($digimon->getNivel() == 1) {
                $dlvl1[$nomDigi] = $nomDigi;
            }
        }
        if (count($dulvl1) == count($dlvl1)) {
            echo "Ya tienes todos los digimon de nivel 1, intenta evolucionar alguno primero, más suerte dentro de 10 partidas<br>";
        } else {
            $d = ""; //Digimon que se va a añadir.
            do {
                $d = array_rand($dlvl1);
            } while (isset($du[$d]));
            $du[$d] = $d;
            $u->setDigimons($du);
            echo "Has conseguido un nuevo digimon<br>";
        }
    }

    public function seleccionarParaCambiar()
    {
        $e = $this->usus[$_SESSION['nombre']]->getEquipo();
        echo "<table><tr>";
        foreach ($e as $nomDigi) {
            $digimon = $this->digimons[$nomDigi];
            echo "<td><img src=";
            echo file_exists("../Digimons/" . $digimon->getNombre() . "/default.png") ? "../Digimons/" . $digimon->getNombre() . "/default.png" : "../Digimons/default.png";
            echo "></td>";
        }
        echo "</tr><tr>";
        foreach ($e as $nomDigi) {
            echo "<td>";
            echo $nomDigi;
            echo "</td>";
        }
        echo "</tr><tr>";
        foreach ($e as $nomDigi) {
        ?>
            <td>
                <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?>>
                    <input type="hidden" name="digimon1" value=<?=$nomDigi;?>>
                    <input type="submit" value="Seleccionar">
                </form>
            </td>
        <?php
        }
        echo "</tr><table>";
    }

    public function seleccionarNuevo()
    {
        $d = $this->usus[$_SESSION['nombre']]->getDigimons(); //Digimon del usuario.
        if (count($d) == 3) { //Si el usuario solo tiene tres digimon, lo sustituye por el mismo.
            echo "No hay opciones disponibles, todos estan en el equipo.";
            ?>
            <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?>>
                <input type="hidden" name="digimon2" value=<?=$_REQUEST['digimon1'];?>>
                <input type="submit" value="Volver">
            </form>
            <?php
        } else {
            $e = $this->usus[$_SESSION['nombre']]->getEquipo(); //Equipo del usuario.
            ?>
            <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?>>
                <select name="digimon2">
                <?php
                foreach ($d as $nomDigi) {
                    if (!isset($e[$nomDigi])) echo "<option value={$nomDigi}>{$nomDigi}</option>";
                }
                ?>
                </select>
                <input type="hidden" name="digimon1" value=<?=$_REQUEST['digimon1'];?>>
                <input type="submit" value="Seleccionar">
            </form>
            <?php
        }
    }

    public function cambiarEquipo ()
    {
        if (!isset($_REQUEST['digimon1'])) $this->seleccionarParaCambiar();
        if (isset($_REQUEST['digimon1']) && !isset($_REQUEST['digimon2'])) $this->seleccionarNuevo();
        if (isset($_REQUEST['digimon1'], $_REQUEST['digimon2'])) {
            $e = $this->usus[$_SESSION['nombre']]->getEquipo(); //Equipo del usuario. 
            $d1 = $_REQUEST['digimon1'];
            $d2 = $_REQUEST['digimon2'];
            unset($e[$d1]);
            $e[$d2] = $d2;
            $this->usus[$_SESSION['nombre']]->setEquipo($e);

            $_REQUEST=[];

            $equipoSerializado = serializar($this->usus[$_SESSION['nombre']]->getEquipo());
            $fichero = fopen("../Usus/{$_SESSION['nombre']}/miEquipo.txt", 'w', TRUE);
            fwrite($fichero, $equipoSerializado);
            fclose($fichero);

            $ususSerializado = serializar($this->usus);
            $fichero = fopen('../usus.txt', 'w', TRUE);
            fwrite($fichero, $ususSerializado);
            fclose($fichero);

            $this->seleccionarParaCambiar();
        }
    }

    public function digievolucionar ()
    {
        $u = $this->usus[$_SESSION['nombre']]; //Usuario.
        
        if (!isset($_REQUEST['digimon'])) {
            echo "Puedes digievolucionar a " . $u->getTokenDigievolucion() . "<br>";
            if ($u->getTokenDigievolucion() > 0) {
                echo "Los digimon del equipo no están disponibles, si quieres digievoluciar a alguno, primero tendrás que sacarlo<br>";
                $posibles = [];
                foreach ($u->getDigimons() as $nomDigi) {
                    $d = $this->digimons[$nomDigi];
                    if ($d->getNivel() != 3 && !isset($u->getEquipo()[$nomDigi]) && ($d->getDigievolucion() != NULL && !isset($u->getDigimons()[$d->getDigievolucion()]))) {
                        $posibles[$nomDigi] = $nomDigi;
                    }
                }
                if (count($posibles) == 0) {
                    echo "Ningun digimon cumple con las características para digievolucionar en este momento<br>";
                } else {
                    ?>
                    <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?>>
                        <select name="digimon">
                            <?php
                            foreach ($posibles as $nomDigi) {
                                echo "<option value={$nomDigi}>{$nomDigi}</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Seleccionar">
                    </form>
                    <?php
                }
            } else echo "No puedes hacer aun ninguna digievolucion, sigue jugando<br>";
        } else {
            $nomDigi1 = $_REQUEST['digimon']; //Nombre del digimon para digievolucionar.
            $d = $this->digimons[$nomDigi1]; //Digimon a digievolucionar.
            $nomDigi2 = $d->getDigievolucion(); //Nombre del digimon al que digievolucionar.
            $du = $u->getDigimons(); //Digimon del usuario antes de la digievolucion.

            unset($du[$nomDigi1]);
            $du[$nomDigi2] = $nomDigi2;
            
            $this->usus[$u->getNombre()]->setDigimons($du);

            $this->usus[$u->getNombre()] ->setTokenDigievolucion($this->usus[$u->getNombre()]->getTokenDigievolucion() - 1);

            $partidas = "{$u->getTokenDigievolucion()}:{$u->getPJugadas()}:{$u->getPGanadas()}";
            $fichero = fopen("../Usus/{$u->getNombre()}/partidas.txt", 'w', TRUE);
            fwrite($fichero, $partidas);
            fclose($fichero);
            
            $duSerializado = serializar($u->getDigimons());
            $fichero = fopen("../Usus/{$u->getNombre()}/misDigimons.txt", 'w', TRUE);
            fwrite($fichero, $duSerializado);
            fclose($fichero);

            $ususSerializado = serializar($this->usus);
            $fichero = fopen('../usus.txt', 'w', TRUE);
            fwrite($fichero, $ususSerializado);
            fclose($fichero);

            $_REQUEST = [];

            echo "El digimon a digievolucionado correctamente<br>";

            ?>
            <form method="POST" action=<?= $_SERVER['PHP_SELF'] ?>>
                <input type="submit" value="Volver">
            </form>
            <?php
        }
    }
}
