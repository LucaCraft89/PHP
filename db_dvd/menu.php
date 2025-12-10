<?php
require_once("auth/checkAuth.php");
require_once("../lib/head.html");
error_reporting(0);
$navName = "Home"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <div class="row g-4">
            <!-- Visualizza Tabelle -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><i class="bi bi-table"></i> Visualizza Tabelle</h4>
                        <div class="list-group">
                            <?php
                            require_once("./dbKit.php");
                            $DB = ConnectToDB();
                            $FetchAvailableTables = $DB->query("SHOW TABLES");

                            if ($FetchAvailableTables) {
                                while ($row = $FetchAvailableTables->fetch_array(MYSQLI_NUM)) {
                                    echo '<a href="showTable.php?table=' . $row[0] . '" class="list-group-item list-group-item-action bg-dark text-light border-secondary mb-1">' . $row[0] . '</a>';
                                }
                            } else {
                                echo "Error fetching tables: " . $DB->error;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DVD noleggiati dal Cliente -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><i class="bi bi-person-circle"></i> DVD Noleggiati dal Cliente</h4>
                        <form action="lookupClientRentals.php" method="post">
                            <div class="mb-3">
                                <label for="searchKey" class="form-label">Cerca per:</label>
                                <input type="text" name="searchKey" id="searchKey"
                                    class="form-control bg-dark text-light border-secondary"
                                    placeholder="Inserisci valore..." required>
                            </div>
                            <div class="mb-3">
                                <select name="searchType" class="form-select bg-dark text-light border-secondary">
                                    <option value="1">Codice Tessera</option>
                                    <option value="2">Telefono</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cerca</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cerca per categoria -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><i class="bi bi-tag"></i> Cerca per Categoria</h4>
                        <form action="lookupCategories.php" method="post">
                            <div class="mb-3">
                                <label for="cat" class="form-label">Seleziona categoria:</label>
                                <select name="cat" id="cat" class="form-select bg-dark text-light border-secondary">
                                    <?php
                                    $SelectAllCategories = $DB->prepare("SELECT * FROM tblCategorie WHERE 1");
                                    $SelectAllCategories->execute();
                                    $cats = $SelectAllCategories->get_result();
                                    while ($catRow = $cats->fetch_assoc()) {
                                        echo ('<option value="' . $catRow['CodCategoria'] . '">' . $catRow['Nome'] . '</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cerca</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cerca per iniziale -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><i class="bi bi-alphabet"></i> Cerca Attori per Iniziale</h4>
                        <form action="lookupLetter.php" method="post">
                            <div class="mb-3">
                                <label for="iniziale" class="form-label">Iniziale nome:</label>
                                <input type="text" name="iniziale" id="iniziale"
                                    class="form-control bg-dark text-light border-secondary" placeholder="Es: A"
                                    maxlength="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cerca</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cerca per regista -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><i class="bi bi-film"></i> Cerca per Regista</h4>
                        <form action="lookupDirected.php" method="post">
                            <div class="mb-3">
                                <label for="regista" class="form-label">Cognome regista:</label>
                                <input type="text" name="regista" id="regista"
                                    class="form-control bg-dark text-light border-secondary"
                                    placeholder="Es: Ozpetek, Argento" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cerca</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- DVD più affittato -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title mb-3"><i class="bi bi-trophy"></i> DVD Più Affittato</h4>
                        <p class="text-muted">Visualizza il DVD con il maggior numero di noleggi</p>
                        <a href="mostRented.php" class="btn btn-primary w-100 mt-auto">Visualizza</a>
                    </div>
                </div>
            </div>

            <!-- Lista Clienti -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title mb-3"><i class="bi bi-trophy"></i> Lista Clienti</h4>
                        <p class="text-muted">Visualizza Lista Clienti Per Modificarla</p>
                        <a href="clienti.php" class="btn btn-primary w-100 mt-auto">Visualizza</a>
                    </div>
                </div>
            </div>

            <!-- Lista DVD -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title mb-3"><i class="bi bi-trophy"></i> Lista DVD</h4>
                        <p class="text-muted">Visualizza Lista DVD Per Modificarla</p>
                        <h4 class="fw-bold">!!CON LE IMMAGINI!!</h4>
                        <a href="dvd.php" class="btn btn-primary w-100 mt-auto">Visualizza</a>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white h-100 shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><i class="bi bi-film"></i>Aggiungi/Elimina/Visualizza noleggi
                            cliente</h4>
                        <form action="viewDetailedClient.php" method="post" target="_Self">
                            <div class="mb-3">
                                <label for="regista" class="form-label">Cliente:</label>
                                <select name="CodTessera" class="form-select bg-dark text-light border-secondary">
                                    <?php
                                    $SelectAllCilents = $DB->prepare("SELECT Nome, Cognome, CodTessera FROM tblClienti WHERE 1");
                                    $SelectAllCilents->Execute();
                                    $FoundClients = $SelectAllCilents->get_result();
                                    while ($Client = $FoundClients->fetch_assoc()) {
                                        echo ('<option value="' . $Client['CodTessera'] . '"> ' . $Client['Nome'] . ' ' . $Client['Cognome'] . '</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cerca</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>