<?php
require_once("../lib/head.html");

$types = [
    "good",
    "cool",
    "charming",
    "funny"
]
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("../lib/header.php");
    require_once("../lib/back.htm");
    ?>

    <div class="d-flex my-auto justify-content-center">
        <form class="align-items-center" name="form_compliments" method="post"
            action="<?php basename($_SERVER['SCRIPT_FILENAME']) ?>">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="compliments-name" name="compliments-name">
                <label for="compliments-name">Complimented person name</label>
            </div>
            <div class="mb-3 ">
                <?php
                foreach ($types as $type) {
                    echo ('<input required type="radio" class="btn-check m-2" name="compliments" value="' . strtolower(str_replace(" ", "_", $type)) . '" id="compliment-' . strtolower(str_replace(" ", "_", $type)) . '" autocomplete="off"
                    >
                <label class="btn btn-outline-primary" for="compliment-' . strtolower(str_replace(" ", "_", $type)) . '">' . $type . '</label>');
                }

                ?>
            </div>
            <div class="mb-3 ">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="compliments-text" name="compliments-text"
                        style="height: 100px"></textarea>
                    <label for="compliments-text">Extra text</label>
                </div>
            </div>


            <button type="submit" class="btn btn-primary w-100 text-center" name="submit-compliments">Submit</button>
        </form>

    </div>


    <?php
    if (isset($_POST['submit-compliments'])) {
        echo ('<div class="mx-4 mt-2 d-flex my-auto justify-content-center alert alert-info">');

        $name = $_POST['compliments-name'];
        $compliment = $_POST['compliments'];
        $extra = $_POST['compliments-text'];

        echo ('<p class="font-monospace d-flex align-items-center">'.$name.' you are ' . $compliment . ' and wanted to tell you ' .$extra.'</p> ');
    }
    echo ('</div>')
        ?>
</body>