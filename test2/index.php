<?php
require_once("../head.html");
$icon1 = "calendar_today"
    ?>


<body class="bg-dark text-light">
    <header>
        <h1 class="w-100 align-items-center text-center pt-3">Hello World</h1>
    <div class="d-flex my-auto justify-content-center">
        <?php
        echo ('<p class="font-monospace d-flex align-items-center">
        <span style="color:lightblue;" class="material-icons pe-2">' . $icon1 . '</span>
        ' . date("Y/m/d") . '
        </p> ');
        ?>
    </div>
    </header>
    
    
</body>