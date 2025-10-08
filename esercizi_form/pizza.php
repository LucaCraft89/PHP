<?php
require_once("../lib/head.html");

$pizzas = ["Margherita", "Diavola", "Quattro Stagioni"]
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("../lib/header.php");
    require_once("../lib/back.htm");
    ?>
    <div class="d-flex my-auto justify-content-center">
        <form class="align-items-center" name="form_pizzas" method="post"
            action="<?php basename($_SERVER['SCRIPT_FILENAME']) ?>">
            <div class="mb-3 ">
                <label for="pizza-count" class="form-label">Pizza Count</label>
                <input required type="number" min="1" class="form-control" id="pizza-count" name="pizza-count">
            </div>
            <div class="mb-3 ">
                <?php
                foreach ($pizzas as $pizza) {
                    echo ('<input required type="radio" class="btn-check m-1" name="pizzas" value="' . strtolower(str_replace(" ", "_", $pizza)) . '" id="pizza-' . strtolower(str_replace(" ", "_", $pizza)) . '" autocomplete="off"
                    >
                <label class="btn btn-outline-primary" for="pizza-' . strtolower(str_replace(" ", "_", $pizza)) . '">' . $pizza . '</label>');
                }

                ?>
            </div>

            <button type="submit" class="btn btn-primary w-100 text-center" name="submit-pizzas">Submit</button>
        </form>

    </div>

        <?php
        if (isset($_POST['submit-pizzas'])) {
                echo('<div class="mx-4 mt-2 d-flex my-auto justify-content-center alert alert-info">');

            $pizzacount = $_POST['pizza-count'];
            echo ('<p class="font-monospace d-flex align-items-center"> Grazie per aver ordinato ' . $pizzacount . ' pizz' . (($pizzacount == 1) ? "a" : "e") . ' ' . $_POST['pizzas'] . ', il bagno si trova più avanti sulla sinistra, ti servirà ;)</p> ');
        }
        echo('</div>')
        ?>
</body>