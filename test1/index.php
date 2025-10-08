<?php
require_once("../lib/head.html");
$icon1 = "calendar_today"
    ?>


<body class="bg-dark text-light">
    <h1 class="w-100 align-items-center text-center pt-3">Hello World</h1>
    <div class="d-flex my-auto justify-content-center">
        <?php
        echo ('<p class="font-monospace d-flex align-items-center">
        <span style="color:lightblue;" class="material-icons pe-2">' . $icon1 . '</span>
        ' . date("Y/m/d") . '
        </p> ');
        ?>
    </div>
    <form class="align-items-center position-absolute top-50 start-50 translate-middle " name="form_age"
        method="get" action="index.php" >
        <div class="mb-3 w-50">
            <label for="age" class="form-label">Age</label>
            <input required name="age" type="number" class="form-control" id="age">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php
    var_dump($_GET);
    print_r(isset($_GET['age']));

    if (isset($_GET["age"])): ?>
        <div class="d-flex my-auto justify-content-center">
            <?php
            echo ('<p class="font-monospace d-flex align-items-center">
            ' . ($_GET['age'] * 7) . '</p> ');
            ?>
        </div>
    <?php endif; ?>
</body>