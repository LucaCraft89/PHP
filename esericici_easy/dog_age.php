<?php
require_once("../lib/head.html");
$icon1 = "calendar_today"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("../lib/header.php");
    require_once("../lib/back.htm");
    ?>
    <div class="d-flex my-auto justify-content-center">
        <form class="align-items-center" name="form_age" method="get" action="">
            <div class="mb-3 ">
                <label for="age" class="form-label">Age</label>
                <input required type="number" class="form-control" id="age">
            </div>
            <button type="submit" class="btn btn-primary w-100 text-center">Submit</button>
        </form>
    </div>

    <?php
    if (isset($_GET["age"])): ?>
        <div class="mt-1 d-flex my-auto justify-content-center">
            <?php
            echo ('<p class="font-monospace d-flex align-items-center"> Dog Age =
            ' . ($_GET['age'] * 7) . '</p> ');
            ?>
        </div>
    <?php endif; ?>
</body>