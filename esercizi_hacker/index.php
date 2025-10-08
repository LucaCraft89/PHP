<?php
require_once("../lib/head.html");
?>


<body class="bg-dark text-light">
<?php
require_once("../lib/header.php");

?>
<div class="position-absolute top-0 end-0 m-2">
  <a href="../" class="btn btn-danger">Back</a>
</div>

<h2 class="w-100 align-items-center text-center pt-3">Seleziona Esercizio</h2>
<div class="m-3 row row-cols-1 row-cols-md-4 g-2">

<?php
$files = scandir('./');
$dir=dirname($_SERVER['PHP_SELF']);
foreach ($files as $file) {
if ($file == "." || $file == ".." || $file == "index.php" || $file == "") {
    continue;
}
    echo('<div class="col">
        <div class="card bg-danger text-white">
            <div class="card-body ">
                <h5 class="card-title">'.$file.'</h5>
                <a href="'.$dir.'/'.$file.'" class="btn btn-primary">Select</a>
            </div>
        </div>
    </div>
    ');

}

?>
</div>
</body>