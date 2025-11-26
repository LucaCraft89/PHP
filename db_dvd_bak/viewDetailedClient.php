<?php
require_once("../lib/head.html");
error_reporting(0);
$navName = "Show Customer Info"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
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
                                    <th scope="col">Azione</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($rentalsRow = $FoundTable->fetch_assoc()) {
                echo "<tr>
                    <td>{$rentalsRow['CodTessera']}</td>
                    <td>{$rentalsRow['Nome']}</td>
                    <td>{$rentalsRow['Cognome']}</td>
                    <td>{$rentalsRow['CodDvd']}</td>
                    <td>{$rentalsRow['Titolo']}</td>
                    <td>{$rentalsRow['NomeCategoria']}</td>
                    <td>
                        <a class='btn btn-danger' href='removeRental.php?id={$rentalsRow['CodNoleggio']}' role='button'>ELIMINA</a>
                    </td>
                </tr>";
            }
            echo ('      </tbody>
                        </table>
                    </div>
                </div>
            </div>');
        }
    ?>

    <main role="main" class="container py-4">
        <div class="card bg-secondary text-white shadow">
            <div class="card-body">
                <?php
                require_once("./dbKit.php");
                $DB = ConnectToDB();

                if (isset($_POST['CodTessera'])) {
                    //fetch dati colonne
                    $FetchTableContent = $DB->prepare("SELECT 
                                                        c.CodTessera,
                                                        c.Nome,
                                                        c.Cognome,
                                                        d.CodDvd,
                                                        d.Titolo,
                                                        d.CodCategoria,
                                                        n.CodNoleggio,
                                                        cat.Nome as NomeCategoria
                                                        FROM tblClienti AS c
                                                        JOIN tblNoleggi AS n ON c.CodTessera = n.CodTessera
                                                        JOIN tblDvd AS d ON d.CodDvd = n.CodDvd
                                                        JOIN tblCategorie AS cat ON d.CodCategoria = cat.CodCategoria 
                                                        WHERE c.CodTessera = ?;
                                                    ");
                    $FetchTableContent->bind_param("i", $_POST['CodTessera']);
                    $FetchTableContent->execute();
                    $FoundData = $FetchTableContent->get_result();
                    PrintFoundTable($FoundData);
                    ?>
                        <form action="insertNoleggio.php" method="POST" class="p-4 bg-dark text-light rounded shadow">
                            <h4 class="mb-4 text-center text-info">Inserisci Nuovo Noleggio</h4>

                            <!-- Cod Tessera -->
                            <input type="hidden" name="id" value="<?php echo($_POST['CodTessera']);?>">

                            <!-- Cod DVD -->
                            <div class="mb-3">
                                <label for="CodDvd" class="form-label"> DVD</label>
                                <select name="CodDVD" class="form-select">
                                <?php
                                    $PippoMolto = $DB->prepare("SELECT CodDvd, Titolo FROM tblDvd");
                                    $PippoMolto->execute();
                                    $Cocaina = $PippoMolto->get_result();
                                    while($Coca = $Cocaina->fetch_assoc()) {
                                        echo('<option value="'.$Coca['CodDvd'].'">'.$Coca['Titolo'].'</option>');
                                    }
                                ?>
                                </select>
                            </div>

                            <!-- Data Noleggio -->
                            <div class="mb-3">
                                <label for="DataNoleggio" class="form-label">Data Noleggio</label>
                                <input type="date" class="form-control" id="DataNoleggio" name="DataNoleggio" required>
                            </div>

                            <!-- Data Scadenza -->
                            <div class="mb-3">
                                <label for="DataScadenza" class="form-label">Data Scadenza</label>
                                <input type="date" class="form-control" id="DataScadenza" name="DataScadenza" required>
                            </div>

                            <!-- Tariffa Giornaliera -->
                            <div class="mb-3">
                                <label for="TariffaGiornaliera" class="form-label">Tariffa Giornaliera (€)</label>
                                <input type="number" step="0.01" class="form-control" id="TariffaGiornaliera" name="TariffaGiornaliera" placeholder="Inserisci la tariffa giornaliera" required>
                            </div>

                            <!-- Pulsanti -->
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-secondary">Annulla</button>
                                <button type="submit" class="btn btn-success">Salva Noleggio</button>
                            </div>
                            </form>

                    <?php
                } else {
                    header("Location: index.php");
                    exit();
                }
                ?>
            </div>
        </div>

        <div class="mt-4">
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna al Menu
            </a>
        </div>
    </main>
</body>

</html>