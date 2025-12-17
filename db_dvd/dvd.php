<?php
require_once("auth/checkAuth.php");
require_once("../lib/head.html");
error_reporting(0);
$navName = "DVD"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <h3 class="mb-4"><i class="bi bi-disc"></i> Lista DVD</h3>
        <?php
        function getCategories($CodCategoria, $cats)
        {
            $categories = "";
            foreach($cats as $catRow){
                $categories = $categories."<option" . (($CodCategoria == $catRow['CodCategoria']) ? "selected " : "") . " value='" . $catRow['CodCategoria'] . "'>" . $catRow['Nome'] . "</option>\n";
            }
            return $categories;
        }
        function PrintFoundTable($FoundTable, $FoundCat)
        {
            $cats = $FoundCat->fetch_all(MYSQLI_ASSOC);
            echo ('<div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
<th scope="col">IMG</th>
                                <th scope="col">CodDvd</th>
<th scope="col">Categoria</th>
<th scope="col">Titolo</th>
<th scope="col">Durata</th>
<th scope="col">Azione</th>
                                </tr>
                            </thead>
                            <tbody>');
            while ($dvdRow = $FoundTable->fetch_assoc()) {
                echo ("<tr>
<td>
<a href = 'edit_img.php?idDvd=". $dvdRow['CodDvd']."'>
       <img width='200px' height='200px' src='assets/dvd_img/".((file_exists("assets/dvd_img/". $dvdRow['CodDvd'].".png")? $dvdRow['CodDvd'] : "default")).".png' class='img-thumbnail'>
</a>
       </td>
<form method='post' action='" . basename($_SERVER['SCRIPT_FILENAME']) . "'>
<td>
        <input required readonly class='form-control' type='number' name='CodDvd' id='CodDvd' placeholder='CodDvd' value='" . htmlspecialchars($dvdRow['CodDvd']) . "'>
</td>
<td>
        <select class='form-select' aria-label='Default select example' name='CodCategoria' id='CodCategoria'>
" .
 getCategories(htmlspecialchars($dvdRow['CodCategoria']), $cats)
                    . "

</select>        
        </td>
<td>
        <input required class='form-control' type='text' name='Titolo' id='Titolo' placeholder='Titolo' value='" . htmlspecialchars($dvdRow['Titolo']) . "'>
</td>
<td>
        <input required class='form-control' type='time' step='1' name='Durata' id='Durata' placeholder='Durata' value='" . htmlspecialchars($dvdRow['Durata']) . "'>
</td>
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
    <input required class='form-control' type='number' name='CodCategoria' id='CodCategoria' placeholder='CodCategoria'>
</td>
<td>
    <input required class='form-control' type='text' name='Titolo' id='Titolo' placeholder='Titolo'>
</td>
<td>
    <input required class='form-control' type='time' step='1' name='Durata' id='Durata' placeholder='Durata'>
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
        $SelectDvd = $DB->prepare("SELECT * FROM tblDvd");
        $SelectDvd->execute();
        $FoundDvd = $SelectDvd->get_result();
        $SelectCat = $DB->prepare("SELECT * FROM tblCategorie");
        $SelectCat->execute();
        $FoundCat = $SelectCat->get_result();
        PrintFoundTable($FoundDvd, $FoundCat);

        if (isset($_POST['delete'])) {
            deleteDvd($_POST['CodDvd']);

        }
        if (isset($_POST['insert'])) {
            insertDvd(
                $_POST['CodCategoria'],
                $_POST['Titolo'],
                $_POST['Durata']
            );

        }
        if (isset($_POST['update'])) {
            updateDvd(
                $_POST['CodDvd'],
                $_POST['CodCategoria'],
                $_POST['Titolo'],
                $_POST['Durata']
            );
        }

        ?>


        <div class="mt-4">
            <a href="menu.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna al Menu
            </a>
        </div>
        <?php
        function deleteDvd($CodDvd)
        {
            $DB = ConnectToDB();
            $DeleteDvd = $DB->prepare("
            DELETE FROM tblDvd 
            WHERE CodDvd = ?
            ");
            $DeleteDvd->bind_param("i", $CodDvd);
            $DeleteDvd->execute();
            unset($_POST);

        }
        function insertDvd($CodCategoria, $Titolo, $Durata)
        {
            $DB = ConnectToDB();

            $InsertDvd = $DB->prepare("
            INSERT INTO tblDvd 
            (CodDvd, CodCategoria, Titolo, Durata)
            VALUES(NULL, ?, ?, ?)
            ");

            $InsertDvd->bind_param("iss", $CodCategoria, $Titolo, $Durata);
            $InsertDvd->execute();
            unset($_POST);

        }
        function updateDvd($CodDvd, $CodCategoria, $Titolo, $Durata)
        {
            $DB = ConnectToDB();
            $UpdateDvd = $DB->prepare("
            UPDATE tblDvd
            SET CodCategoria = ?, Titolo = ?, Durata = ?
            WHERE CodDvd = ?;  
            ");
            $UpdateDvd->bind_param("issi", $CodCategoria, $Titolo, $Durata, $CodDvd);
            $UpdateDvd->execute();
            unset($_POST);
        }
        ?>
    </main>
</body>

</html>