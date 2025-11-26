<?php
require_once("auth/checkAuth.php");
require_once("../lib/head.html");
error_reporting(0);
$navName = "Più Affittato"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <h3 class="mb-4"><i class="bi bi-trophy"></i> DVD Più Affittato</h3>

        <?php
        function PrintFoundTable($FoundTable)
        {
            echo ('<div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">ID DVD</th>
                                    <th scope="col">Titolo</th>
                                    <th scope="col">Durata (min)</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Numero di Affitti</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($rentalsRow = $FoundTable->fetch_assoc()) {
                echo ("<tr class='table-warning'>
                        <td><strong>" . $rentalsRow['CodDvd'] . "</strong></td>
                        <td><strong>" . $rentalsRow['Titolo'] . "</strong></td>
                        <td>" . $rentalsRow['Durata'] . "</td>
                        <td>" . $rentalsRow['NomeCategoria'] . "</td>
                        <td><span class='badge bg-success fs-6'>" . $rentalsRow['NumOccorrenze'] . "</span></td>
                    </tr>");
            }
            echo ('      </tbody>
                        </table>
                    </div>
                </div>
            </div>');
        }

        require_once("./dbKit.php");
        $DB = ConnectToDB();
        $SelectDvdsRented = $DB->prepare("SELECT 
                                        n.CodDvd,
                                        d.Titolo,
                                        d.Durata,
                                        c.Nome AS NomeCategoria,
                                        COUNT(*) AS NumOccorrenze
                                    FROM tblNoleggi AS n
                                    JOIN tblDvd AS d ON n.CodDvd = d.CodDvd
                                    JOIN tblCategorie AS c ON d.CodCategoria = c.CodCategoria
                                    GROUP BY n.CodDvd, d.Titolo, d.Durata, c.Nome
                                    ORDER BY NumOccorrenze DESC
                                    LIMIT 1;
                                    ");
        $SelectDvdsRented->execute();
        $FoundDvdRentals = $SelectDvdsRented->get_result();
        PrintFoundTable($FoundDvdRentals);
        ?>

        <div class="mt-4">
            <a href="menu.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna al Menu
            </a>
        </div>
    </main>
</body>

</html>