<?php
require_once("../lib/head.html");
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("../lib/header.php");
    require_once("../lib/back.htm");
    ?>
    <div class="d-flex my-auto justify-content-center">
        <form class="align-items-center" name="form_dices" method="post"
            action="<?php basename($_SERVER['SCRIPT_FILENAME']) ?>">
            <div class="mb-3 ">
                <label for="dice-count" class="form-label">Dice Count</label>
                <input required type="number" min="1" max="10" class="form-control" id="dice-count" name="dice-count">
            </div>


            <button type="submit" class="btn btn-primary w-100 text-center" name="submit-dices">Submit</button>
        </form>

    </div>
    <div class="justify-content-center">
        <div class="m-3 row row-cols-1 row-cols-md-6 g-2 ">

            <?php
            if (isset($_POST['submit-dices'])) {
                $dicecount = $_POST['dice-count'];
                for ($i = 0; $i < $dicecount; $i++) {
                    echo ('<div class="col">
        <div class="card bg-success text-white">
            <div class="card-body ">
                <h5 class="card-title"> Dice ' . $i . '</h5>
                <p class="card-text font-monospace fs-3">' . (random_int(1, 6)) . '</p>
            </div>
        </div>
    </div>');
                }
            }
            ?>
        </div>
    </div>
</body>