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
            ');
        }

        function showForm($id): void
        {
            echo ('

<div class="d-flex justify-content-center mt-4">
    <div class="bg-black bg-opacity-75 p-4 rounded">
        <form enctype="multipart/form-data" class="row row-cols-lg-auto g-3 align-items-end" method="post" action="' . basename($_SERVER['SCRIPT_FILENAME']) . '">
         <input required readonly hidden type="number" name="idDvd" id="idDvd" value="' . $id . '">
         </td>
          <div class="col-12">
                    <label for="newImg" class="form-label">Nuova Immagine</label>
                    <input required accept="image/png" class="form-control" id="newImg" type="file" name="newImg">
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
</div>
            <script>
            newImg.onchange = evt => {
  const [file] = newImg.files
  if (file) {
    blah.src = URL.createObjectURL(file)
    newImageCol.style.display = "block"
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

        if (isset($_GET['idDvd'])) {
            showImg($_GET['idDvd']);
            showForm($_GET['idDvd']);
        }
        if (isset($_POST['idDvd'])) {
            $status = editImg($_POST['idDvd']);
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