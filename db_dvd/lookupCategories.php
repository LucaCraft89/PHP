<?php
require_once("../lib/head.html");
error_reporting(0);
$navName = "Categorie"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <h3 class="mb-4"><i class="bi bi-tag"></i> Ricerca per Categoria</h3>

        <?php
        function PrintFoundTable($FoundTable)
        {
            echo ('<div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Titolo</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Durata (min)</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($rentalsRow = $FoundTable->fetch_assoc()) {
                echo ("<tr>
                        <td>" . $rentalsRow['Titolo'] . "</td>
                        <td>" . $rentalsRow['nCat'] . "</td>
                        <td>" . $rentalsRow['Durata'] . "</td>
                    </tr>");
            }
            echo ('      </tbody>
                        </table>
                    </div>
                </div>
            </div>');
        }

        if (isset($_POST['cat'])) {
            $Categoria = (int) $_POST['cat'];
            require_once("./dbKit.php");
            $DB = ConnectToDB();
            $SelectDvdsRented = $DB->prepare("SELECT d.Titolo, d.CodCategoria, d.Durata, c.Nome as nCat FROM tblDvd AS d
                                            JOIN tblCategorie AS c ON c.CodCategoria = d.CodCategoria
                                            WHERE c.CodCategoria = ?");
            $SelectDvdsRented->bind_param("i", $Categoria);
            $SelectDvdsRented->execute();
            $FoundDvdRentals = $SelectDvdsRented->get_result();
            PrintFoundTable($FoundDvdRentals);
        }
        ?>

        <div class="mt-4">
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna al Menu
            </a>
        </div>
    </main>
</body>

</html>