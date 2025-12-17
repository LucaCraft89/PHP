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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-disc"></i> Lista DVD</h3>
            <button type="button" class="btn btn-info" id="fetchAllApiBtn">
                <i class="bi bi-cloud-download"></i> Fetch All from API
            </button>
        </div>
        <?php
        function getCategories($CodCategoria, $cats)
        {
            $categories = "";
            foreach ($cats as $catRow) {
                $categories = $categories . "<option" . (($CodCategoria == $catRow['CodCategoria']) ? "selected " : "") . " value='" . $catRow['CodCategoria'] . "'>" . $catRow['Nome'] . "</option>\n";
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
<a href = 'edit_img.php?idDvd=" . $dvdRow['CodDvd'] . "'>
       <img width='200px' height='200px' src='assets/dvd_img/" . ((file_exists("assets/dvd_img/" . $dvdRow['CodDvd'] . ".png") ? $dvdRow['CodDvd'] : "default")) . ".png' class='img-thumbnail'>
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

        <script>
            // IMPORTANT: Replace this with your actual TMDB Read Access Token
            const TMDB_API_KEY = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZTgyNjQ4MmJmNGVkYTE1ZDMzZTJlNzM3NzcxMzE0OSIsIm5iZiI6MTc2NTk2MjQ4Mi40OTUwMDAxLCJzdWIiOiI2OTQyNzJmMjJiZmE5NmFiZWI0ZTNlNTYiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.gtZQfHqDCPdCyO6Jbz-mv9lyvrq08IiEQNIQc5Y5E7I";

            document.getElementById('fetchAllApiBtn').onclick = async () => {
                if (!confirm('This will fetch images for all DVDs from TMDB API. Continue?')) {
                    return;
                }

                const btn = document.getElementById('fetchAllApiBtn');
                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Fetching...';

                // Get all DVD data
                const dvds = [];
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const idInput = row.querySelector('input[name="CodDvd"]');
                    const titleInput = row.querySelector('input[name="Titolo"]');
                    if (idInput && titleInput) {
                        dvds.push({
                            id: idInput.value,
                            title: titleInput.value
                        });
                    }
                });

                let successCount = 0;
                let failCount = 0;

                for (const dvd of dvds) {
                    try {
                        // Search for movie
                        const searchResponse = await fetch(
                            `https://api.themoviedb.org/3/search/movie?query=${encodeURIComponent(dvd.title)}`,
                            {
                                headers: {
                                    Authorization: `Bearer ${TMDB_API_KEY}`,
                                    accept: 'application/json'
                                }
                            }
                        );

                        const searchData = await searchResponse.json();

                        if (searchData.results && searchData.results.length > 0) {
                            const movieId = searchData.results[0].id;

                            // Get images
                            const imagesResponse = await fetch(
                                `https://api.themoviedb.org/3/movie/${movieId}/images`,
                                {
                                    headers: {
                                        Authorization: `Bearer ${TMDB_API_KEY}`,
                                        accept: 'application/json'
                                    }
                                }
                            );

                            const imagesData = await imagesResponse.json();

                            if (imagesData.posters && imagesData.posters.length > 0) {
                                const posterPath = imagesData.posters[0].file_path;
                                const imageUrl = `https://image.tmdb.org/t/p/original${posterPath}`;

                                // Send to server
                                const formData = new FormData();
                                formData.append('idDvd', dvd.id);
                                formData.append('apiImage', imageUrl);
                                formData.append('batchUpdate', '1');

                                const uploadResponse = await fetch('edit_img.php', {
                                    method: 'POST',
                                    body: formData
                                });

                                if (uploadResponse.ok) {
                                    successCount++;
                                    btn.innerHTML = `<i class="bi bi-hourglass-split"></i> Processing ${successCount + failCount}/${dvds.length}...`;
                                } else {
                                    failCount++;
                                }
                            } else {
                                failCount++;
                            }
                        } else {
                            failCount++;
                        }

                        // Small delay to avoid rate limiting
                        await new Promise(resolve => setTimeout(resolve, 250));

                    } catch (error) {
                        console.error(`Error processing ${dvd.title}:`, error);
                        failCount++;
                    }
                }

                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-cloud-download"></i> Fetch All from API';
                alert(`Completed!\\nSuccess: ${successCount}\\nFailed: ${failCount}`);
                location.reload();
            };
        </script>
    </main>
</body>

</html>