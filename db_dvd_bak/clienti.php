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
        <h3 class="mb-4"><i class="bi bi-tag"></i> Lista Clienti</h3>
        <?php
        function PrintFoundTable($FoundTable)
        {
            echo ('<div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
<th scope="col">CodTessera</th>
<th scope="col">Cognome</th>
<th scope="col">Nome</th>
<th scope="col">Via</th>
<th scope="col">NumCivico</th>
<th scope="col">Citta</th>
<th scope="col">Telefono</th>
<th scope="col">DataEmissioneTessera</th>
<th scope="col">Azione</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($clientsRow = $FoundTable->fetch_assoc()) {
                echo ("<tr>
<form method='post' action='" . basename($_SERVER['SCRIPT_FILENAME']) . "'>
<td>
        <input required readonly class='form-control' type='number' name='CodTessera' id='CodTessera' placeholder='CodTessera' value='" . htmlspecialchars($clientsRow['CodTessera']) . "'>
</td>
<td>
        <input required class='form-control' type='text' name='Cognome' id='Cognome' placeholder='Cognome' value='" . htmlspecialchars($clientsRow['Cognome']) . "'>
</td>
<td>
        <input required class='form-control' type='text' name='Nome' id='Nome' placeholder='Nome' value='" . htmlspecialchars($clientsRow['Nome']) . "'>
</td>
<td>
        <input required class='form-control' type='text' name='Via' id='Via' placeholder='Via' value='" . htmlspecialchars($clientsRow['Via']) . "'>
</td>
<td>
        <input required class='form-control' type='number' name='NumCivico' id='NumCivico' placeholder='NumCivico' value='" . htmlspecialchars($clientsRow['NumCivico']) . "'>
</td>
<td>
        <input required class='form-control' type='text' name='Citta' id='Citta' placeholder='Citta' value='" . htmlspecialchars($clientsRow['Citta']) . "'>
</td>
<td>
        <input required class='form-control' type='tel' name='Telefono' id='Telefono' placeholder='Telefono' value='" . htmlspecialchars($clientsRow['Telefono']) . "'>
</td>
<td>" . $clientsRow['DataEmissioneTessera'] . "</td>
<td>
<button class='btn btn-danger' type='submit' name='delete'>Elimina</button>
<button class='btn btn-primary' type='submit' name='update'>Modifica</button>
</td>
</form>
                    </tr>");
            }
            echo ("<tr>
<form method='post' action='" . basename($_SERVER['SCRIPT_FILENAME']) . "'>
<td>
    
</td>
<td>
    <input required class='form-control' type='text' name='Cognome' id='Cognome' placeholder='Cognome'>
</td>
<td>
    <input required class='form-control' type='text' name='Nome' id='Nome' placeholder='Nome'>
</td>
<td>
    <input required class='form-control' type='text' name='Via' id='Via' placeholder='Via'>
</td>
<td>
    <input required class='form-control' type='number' name='NumCivico' id='NumCivico' placeholder='NumCivico'>
</td>
<td>
    <input required class='form-control' type='text' name='Citta' id='Citta' placeholder='Citta'>
</td>
<td>
    <input required class='form-control' type='tel' name='Telefono' id='Telefono' placeholder='Telefono'>
</td>
<td>
    <input required readonly class='form-control' type='date' name='DataEmissioneTessera' id='DataEmissioneTessera' placeholder='DataEmissioneTessera' value='" . htmlspecialchars(date('Y-m-d')) . "'>
</td>
<td>
<button class='btn btn-success' type='submit' name='insert'>Inserisci</button>
</td>
</form>
                    </tr>");
            echo ('      </tbody>
                        </table>
                    </div>
                </div>
            </div>');
        }
        ?>

        <?php
        require_once("./dbKit.php");
        $DB = ConnectToDB();
        $SelectClienti = $DB->prepare("SELECT * FROM tblClienti");
        $SelectClienti->execute();
        $FoundClienti = $SelectClienti->get_result();
        PrintFoundTable($FoundClienti);

        if (isset($_POST['delete'])) {
            deleteClient($_POST['CodTessera']);

        }
        if (isset($_POST['insert'])) {
            insertClient(
                $_POST['Cognome'],
                $_POST['Nome'],
                $_POST['Via'],
                $_POST['NumCivico'],
                $_POST['Citta'],
                $_POST['Telefono'],
                $_POST['DataEmissioneTessera']);

        }
        if (isset($_POST['update'])) {
            updateClient(
                $_POST['CodTessera'],
                $_POST['Cognome'],
                $_POST['Nome'],
                $_POST['Via'],
                $_POST['NumCivico'],
                $_POST['Citta'],
                $_POST['Telefono'],
            );
        }

        ?>


        <div class="mt-4">
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna al Menu
            </a>
        </div>
        <?php
        function deleteClient($CodTessera)
        {
            $DB = ConnectToDB();
            $DeleteCliente = $DB->prepare("
            DELETE FROM tblClienti 
            WHERE CodTessera = ?
            ");
            $DeleteCliente->bind_param("i", $CodTessera);
            $DeleteCliente->execute();
            $ResponseDeleteCliente = $DeleteCliente->get_result();
            unset($_POST);

        }
        function insertClient($Cognome, $Nome, $Via, $NumCivico, $Citta, $Telefono, $DataEmissioneTessera)
        {
            $DB = ConnectToDB();
            $DeleteCliente = $DB->prepare("
            INSERT INTO tblClienti 
            VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            $DeleteCliente->bind_param("sssisis",  $Cognome, $Nome, $Via, $NumCivico, $Citta, $Telefono, $DataEmissioneTessera);
            $DeleteCliente->execute();
            $ResponseDeleteCliente = $DeleteCliente->get_result();
            unset($_POST);

        }
        function updateClient($CodTessera, $Cognome, $Nome, $Via, $NumCivico, $Citta, $Telefono)
        {
            $DB = ConnectToDB();
            $DeleteCliente = $DB->prepare("
            UPDATE tblClienti
SET Cognome = ?, Nome = ?, Via=?, NumCivico=?, Citta=?, Telefono=?
WHERE CodTessera= ?;  
            ");
            $DeleteCliente->bind_param("sssisii", $Cognome, $Nome, $Via, $NumCivico, $Citta, $Telefono, $CodTessera);
            $DeleteCliente->execute();
            $ResponseDeleteCliente = $DeleteCliente->get_result();
            unset($_POST);
        }
        ?>
    </main>
</body>

</html>