<?php
require_once("auth/checkAuth.php");
require_once("../lib/head.html");
error_reporting(0);
$navName = "img_edit"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <h3 class="mb-4"><i class="bi bi-disc"></i> Lista DVD</h3>

        <?php
        function showImg($id)
        {
            require_once("dbKit.php");
            $DB = ConnectToDB();
            $stmt = $DB->prepare("SELECT Titolo FROM tblDvd WHERE CodDvd = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $movieTitle = "";
            if ($row = $result->fetch_assoc()) {
                $movieTitle = $row['Titolo'];
            }

            echo ('
            <div class="row justify-content-center">
                <div class="col-auto text-center">
                    <h5>Old Image</h5>
                    <img width="300px" height="300px" src="' . getImgPath($id) . '" class="img-fluid img-thumbnail rounded" >
                </div>
                <div id="newImageCol" class="col-auto text-center" style="display:none;">
                    <h5>New Image</h5>
                    <img id="blah" width="300px" height="300px" src="#" alt="Preview" class="img-fluid img-thumbnail rounded">
                </div>
            </div>
            <input type="hidden" id="movieTitle" value="' . htmlspecialchars($movieTitle) . '">
            <input type="hidden" id="apiImageUrl" value="">
            ');
        }

        function showForm($id): void
        {
            echo ('

<div class="d-flex justify-content-center mt-4">
    <div class="bg-black bg-opacity-75 p-4 rounded">
        <form id="uploadForm" enctype="multipart/form-data" class="row row-cols-lg-auto g-3 align-items-end" method="post" action="' . basename($_SERVER['SCRIPT_FILENAME']) . '">
         <input readonly hidden type="number" name="idDvd" id="idDvd" value="' . $id . '">
         <input type="hidden" name="apiImage" id="apiImageInput" value="">
         </td>
          <div class="col-12">
                    <label for="newImg" class="form-label">Nuova Immagine</label>
                    <input accept="image/png" class="form-control" id="newImg" type="file" name="newImg">
          </div>

          <div class="col-12">
            <button type="button" class="btn btn-info" id="getApiBtn">Get from API</button>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
          </div>
        </form>
    </div>
</div>
            <script>
            // IMPORTANT: Replace this with your actual TMDB Read Access Token from https://www.themoviedb.org/settings/api
            const TMDB_API_KEY = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0ZTgyNjQ4MmJmNGVkYTE1ZDMzZTJlNzM3NzcxMzE0OSIsIm5iZiI6MTc2NTk2MjQ4Mi40OTUwMDAxLCJzdWIiOiI2OTQyNzJmMjJiZmE5NmFiZWI0ZTNlNTYiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.gtZQfHqDCPdCyO6Jbz-mv9lyvrq08IiEQNIQc5Y5E7I";
            
            newImg.onchange = evt => {
              const [file] = newImg.files
              if (file) {
                blah.src = URL.createObjectURL(file)
                newImageCol.style.display = "block"
                submitBtn.disabled = false
                apiImageInput.value = ""
              }
            }
            
            getApiBtn.onclick = async () => {
              const movieTitle = document.getElementById("movieTitle").value;
              if (!movieTitle) {
                alert("No movie title found");
                return;
              }
              
              try {
                getApiBtn.disabled = true;
                getApiBtn.innerHTML = "Loading...";
                
                const searchResponse = await fetch(
                  `https://api.themoviedb.org/3/search/movie?query=${encodeURIComponent(movieTitle)}`,
                  {
                    headers: {
                      Authorization: `Bearer ${TMDB_API_KEY}`
                    }
                  }
                );
                
                const searchData = await searchResponse.json();
                
                if (searchData.results && searchData.results.length > 0) {
                  const movieId = searchData.results[0].id;
                  
                  const imagesResponse = await fetch(
                    `https://api.themoviedb.org/3/movie/${movieId}/images`,
                    {
                      headers: {
                        Authorization: `Bearer ${TMDB_API_KEY}`
                      }
                    }
                  );
                  
                  const imagesData = await imagesResponse.json();
                  
                  if (imagesData.posters && imagesData.posters.length > 0) {
                    const posterPath = imagesData.posters[0].file_path;
                    const imageUrl = `https://image.tmdb.org/t/p/original${posterPath}`;
                    blah.src = imageUrl;
                    newImageCol.style.display = "block";
                    document.getElementById("apiImageUrl").value = imageUrl;
                    apiImageInput.value = imageUrl;
                    submitBtn.disabled = false;
                    newImg.value = "";
                    newImg.removeAttribute("required");
                  } else {
                    alert("No poster found for this movie");
                  }
                } else {
                  alert("Movie not found on TMDB");
                }
              } catch (error) {
                alert("Error fetching from API: " + error.message);
              } finally {
                getApiBtn.disabled = false;
                getApiBtn.innerHTML = "Get from API";
              }
            }
            </script>
            ');
        }
        function getImgPath($id): string
        {
            return "assets/dvd_img/" . ((file_exists("assets/dvd_img/" . $id . ".png") ? $id : "default")) . ".png";
        }

        function editImg($id)
        {
            if (!empty($_POST['apiImage'])) {
                $imageUrl = $_POST['apiImage'];
                $imageData = file_get_contents($imageUrl);

                if ($imageData === false) {
                    return "Error downloading image from API";
                }

                if (file_exists("assets/dvd_img/" . $id . ".png")) {
                    rename(getImgPath($id), str_replace(".png", "_bak.png", getImgPath($id)));
                }

                if (file_put_contents("assets/dvd_img/" . $id . ".png", $imageData)) {
                    return "API image saved successfully.";
                } else {
                    return "Error saving API image";
                }
            } else {
                $check = getimagesize($_FILES["newImg"]["tmp_name"]);
                if ($check === false) {
                    return 2;
                }
                if (file_exists("assets/dvd_img/" . $id . ".png")) {
                    rename(getImgPath($id), str_replace(".png", "_bak.png", getImgPath($id)));
                }
                if (move_uploaded_file($_FILES["newImg"]["tmp_name"], "assets/dvd_img/" . $id . ".png")) {
                    return htmlspecialchars(basename($_FILES["newImg"]["name"])) . " caricato con successo.";
                } else {
                    return 1;
                }
            }
        }

        if (isset($_GET['idDvd'])) {
            showImg($_GET['idDvd']);
            showForm($_GET['idDvd']);
        }
        if (isset($_POST['idDvd'])) {
            $status = editImg($_POST['idDvd']);

            // Handle batch update requests (no UI output)
            if (isset($_POST['batchUpdate'])) {
                if ($status === 1 || $status === 2) {
                    http_response_code(500);
                } else {
                    http_response_code(200);
                }
                exit;
            }

            if ($status === 1 || $status === 2) {
                echo ('<div class="alert alert-danger" role="alert">
  ' .

                    ($status === 2 ? "File caricato non è una immagine" : "Errore di caricamento")

                    . '
</div>');
            }
            showImg($_POST['idDvd']);
            showForm($_POST['idDvd']);
        }
        ?>


        <div class="mt-4">
            <a href="dvd.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna ai DVD
            </a>
        </div>

    </main>
</body>

</html>