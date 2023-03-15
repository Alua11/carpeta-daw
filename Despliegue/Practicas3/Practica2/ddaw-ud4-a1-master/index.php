<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Listado Simple de Empresas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="card">
    <h1 class="card-header text-center">
        Listado Empresas
    </h1>
    <div class="card-body mx-auto">
        <div class="row mx-auto ">
            <form class="col-lg-12" action="<?=$_SERVER['PHP_SELF']?>" method="get">
                <div class="active-red-3 input-group mb-4">
                    <input class="form-control" type="text" name="q" placeholder="Buscar por nombre..." aria-label="Buscar nombre...">
                    <input class="btn btn-outline-secondary" type="submit" value="Buscar">
                </div>
            </form>
        </div>
        <?php
        require_once __DIR__ . "/src/repositorio_empresas_pdo.php";
        $validCountries = require_once __DIR__ . "/config/valid_countries.php";

        $searchQuery = isset($_GET['q']) ? $_GET['q'] : "";
        $page = isset($_GET['page']) ? $_GET['page'] : 0;

        $listadoEmpresas = findAll($page, $searchQuery);

        echo "<table class='table text-center'>";
        echo "<tr>
                   <th>id</th>
                   <th>Nombre </th>
                   <th>Dirección</th>
                   <th>Pais</th>
                   <th>Activado</th>
                   <th>Fecha de creación</th>
              </tr>";

        foreach ($listadoEmpresas as $row) {
            echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['address']}</td>
                        <td>{$validCountries[strtolower($row['country'])]}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['createdOn']}</td>
                    </tr>";
        }
        echo "</table>";
        ?>
    </div>
    <div class="row mx-auto">
        <nav aria-label="...">
            <ul class="pagination pagination-md">
                <?php if ($page > 0) :?>
                    <li class="page-item"><a class="page-link" href="/index.php?page=<?=($page - 1)?>&q=<?=$searchQuery?>">Anterior</a></li>
                <?php endif;?>
                <li class="page-item"><a class="page-link" href="/index.php?page=<?=($page + 1)?>&q=<?=$searchQuery?>">Siguiente</a></li>
            </ul>
        </nav>
    </div>
</div>
</body>
</html>