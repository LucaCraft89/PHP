<?php
require_once("../lib/head.html");
error_reporting(0);
$navName = "Ricerca Attori"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <h3 class="mb-4"><i class="bi bi-alphabet"></i> Ricerca Attori per Iniziale</h3>

        <?php
        function PrintFoundTable($FoundTable)
        {
            echo ('<div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cognome</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($rentalsRow = $FoundTable->fetch_assoc()) {
                echo ("<tr>
                        <td>" . $rentalsRow['Nome'] . "</td>
                        <td>" . $rentalsRow['Cognome'] . "</td>
                    </tr>");
            }
            echo ('      </tbody>
                        </table>
                    </div>
                </div>
            </div>');
        }

        if (isset($_POST['iniziale'])) {
            $iniziale = substr($_POST['iniziale'], 0, 1) . '%';
            require_once("./dbKit.php");
            $DB = ConnectToDB();
            $SelectDvdsRented = $DB->prepare("SELECT *
                                            FROM tblAttori
                                            WHERE Nome LIKE ?");
            $SelectDvdsRented->bind_param("s", $iniziale);
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