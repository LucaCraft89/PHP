<?php
require_once("../lib/head.html");
error_reporting(0);
$navName = "Ricerca Registi"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <h3 class="mb-4"><i class="bi bi-film"></i> Ricerca Film per Regista</h3>

        <?php
        function PrintFoundTable($FoundTable)
        {
            echo ('<div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nome Regista</th>
                                    <th scope="col">Cognome Regista</th>
                                    <th scope="col">Titolo DVD</th>
                                    <th scope="col">Codice DVD</th>
                                    <th scope="col">Durata (min)</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($rentalsRow = $FoundTable->fetch_assoc()) {
                echo ("<tr>
                        <td>" . $rentalsRow['NomeRegista'] . "</td>
                        <td>" . $rentalsRow['CognomeRegista'] . "</td>
                        <td>" . $rentalsRow['Titolo'] . "</td>
                        <td>" . $rentalsRow['CodDvd'] . "</td>
                        <td>" . $rentalsRow['Durata'] . "</td>
                    </tr>");
            }
            echo ('      </tbody>
                        </table>
                    </div>
                </div>
            </div>');
        }

        if (isset($_POST['regista'])) {
            $nomeRegista = $_POST['regista'];
            require_once("./dbKit.php");
            $DB = ConnectToDB();
            $SelectDvdsRented = $DB->prepare("SELECT 
                                            d.CodDvd,
                                            d.Titolo,
                                            d.Durata,
                                            r.Nome AS NomeRegista,
                                            r.Cognome AS CognomeRegista
                                        FROM tblDvd AS d
                                        JOIN tblDiretti AS dir ON d.CodDvd = dir.CodDvd
                                        JOIN tblRegisti AS r ON dir.CodRegista = r.CodRegista 
                                        WHERE r.Cognome = ?;
                                        ");
            $SelectDvdsRented->bind_param("s", $nomeRegista);
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