<?php
require_once("auth/checkAuth.php");
require_once("../lib/head.html");
error_reporting(0);
$navName = "Noleggi Cliente"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <h3 class="mb-4"><i class="bi bi-person-circle"></i> DVD Noleggiati dal Cliente</h3>

        <?php
        function PrintFoundTable($FoundTable)
        {
            echo ('<div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Cod Tessera</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cognome</th>
                                    <th scope="col">Cod DVD</th>
                                    <th scope="col">Titolo DVD</th>
                                    <th scope="col">Categoria</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($rentalsRow = $FoundTable->fetch_assoc()) {
                echo ("<tr>
                        <td>" . $rentalsRow['CodTessera'] . "</td>
                        <td>" . $rentalsRow['Nome'] . "</td>
                        <td>" . $rentalsRow['Cognome'] . "</td>
                        <td>" . $rentalsRow['CodDvd'] . "</td>
                        <td>" . $rentalsRow['Titolo'] . "</td>
                        <td>" . $rentalsRow['NomeCategoria'] . "</td>
                    </tr>");
            }
            echo ('      </tbody>
                        </table>
                    </div>
                </div>
            </div>');
        }

        require_once("./dbKit.php");
        if (isset($_POST['searchKey']) && isset($_POST['searchType'])) {
            $SearchType = (int) $_POST['searchType'];
            if ($SearchType > 0 && $SearchType <= 3) {
                switch ($SearchType) {
                    case 1:
                        $CodTessera = (int) $_POST['searchKey'];
                        $DB = ConnectToDB();
                        $SelectDvdsRented = $DB->prepare("SELECT 
                                                        c.CodTessera,
                                                        c.Nome,
                                                        c.Cognome,
                                                        d.CodDvd,
                                                        d.Titolo,
                                                        d.CodCategoria,
                                                        cat.Nome as NomeCategoria
                                                        FROM tblClienti AS c
                                                        JOIN tblNoleggi AS n ON c.CodTessera = n.CodTessera
                                                        JOIN tblDvd AS d ON d.CodDvd = n.CodDvd
                                                        JOIN tblCategorie AS cat ON d.CodCategoria = cat.CodCategoria 
                                                        WHERE c.CodTessera = ?;
                                                    ");
                        $SelectDvdsRented->bind_param("i", $CodTessera);
                        $SelectDvdsRented->execute();
                        $FoundDvdRentals = $SelectDvdsRented->get_result();
                        PrintFoundTable($FoundDvdRentals);
                        break;
                    case 2:
                        $Telefono = (int) $_POST['searchKey'];
                        $DB = ConnectToDB();
                        $SelectDvdsRented = $DB->prepare("SELECT 
                                                        c.CodTessera,
                                                        c.Nome,
                                                        c.Cognome,
                                                        d.CodDvd,
                                                        d.Titolo,
                                                        d.CodCategoria,
                                                        cat.Nome as NomeCategoria
                                                        FROM tblClienti AS c
                                                        JOIN tblNoleggi AS n ON c.CodTessera = n.CodTessera
                                                        JOIN tblDvd AS d ON d.CodDvd = n.CodDvd
                                                        JOIN tblCategorie AS cat ON d.CodCategoria = cat.CodCategoria 
                                                        WHERE c.Telefono = ?;
                                                    ");
                        $SelectDvdsRented->bind_param("i", $Telefono);
                        $SelectDvdsRented->execute();
                        $FoundDvdRentals = $SelectDvdsRented->get_result();
                        PrintFoundTable($FoundDvdRentals);
                        break;
                }
            } else {
                echo '<div class="alert alert-danger">Criterio di ricerca inesistente</div>';
            }
        }
        ?>

        <div class="mt-4">
            <a href="menu.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna al Menu
            </a>
        </div>
    </main>
</body>

</html>