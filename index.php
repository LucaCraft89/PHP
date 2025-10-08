<?php
require_once("./lib/head.html");
?>

<body class="bg-dark text-light">
<?php
require_once("./lib/header.php");
?>

<h2 class="w-100 align-items-center text-center pt-3">Seleziona Cartella</h2>
<div class="m-3 row row-cols-1 row-cols-md-4 g-2">

<?php
$items = scandir('./');
$dir = dirname($_SERVER['PHP_SELF']);
foreach ($items as $item) {
    if ($item == "." || $item == ".." || $item == "index.php" || $item == "") {
        continue;
    }
    if (is_dir($item)) {
        echo('<div class="col">
            <div class="card bg-danger text-white">
                <div class="card-body ">
                    <h5 class="card-title">'.$item.'</h5>
                    <a href="'.$item.'" class="btn btn-primary">Apri Cartella</a>
                </div>
            </div>
        </div>
        ');
    }
}
?>
</div>
</body>