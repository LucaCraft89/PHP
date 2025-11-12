<?php
require_once("../lib/head.html");
$abilities = ["ciaooo", "ciaooo"];
$dbName = "negozio";
// error_reporting(0);

?>

<body class="bg-dark text-light">
    <?php
    require_once("../lib/header.php");
    require_once("../lib/back.htm");
    require_once("../lib/dbconnector.php");
    $conn = dBConnection("localhost", "terrorist", "CS2TheBest", $dbName);
    ?>


    <div class="d-flex my-auto justify-content-center">
        <form class="align-items-center g-3 needs-validation" novalidate method="post"
            action="<?php basename($_SERVER['SCRIPT_FILENAME']) ?>" name="form_table">
            <div class="mb-3">
                <select id="selectTable" name="selectTable" class="form-select" aria-label="Default select example"
                    onchange="this.form.submit()">
                    <option selected disabled">Select Table</option>
                    <?php
                    $query = "SHOW TABLES;";
                    $result = $conn->query($query);
                    while ($row = mysqli_fetch_array($result)) {
                        echo ("<option value='" . $row['Tables_in_' . $dbName] . "'>");
                        echo ($row['Tables_in_' . $dbName]);
                        echo ("</option>");
                    }
                    ?>
                </select>
            </div>
        </form>
    </div>
        <?php
        if (isset($_POST['selectTable'])) {
            echo ('<div class="mx-4 mt-2 d-flex my-auto justify-content-center ">');
echo ('<div class="table-responsive">');
            echo ('<table class="table table-dark">
                    <thead>
                        ');
            $query = "DESCRIBE " . $_POST['selectTable'] . ";";
            $result = $conn->query($query);


            while ($row = mysqli_fetch_array($result)) {
                echo ("<th scope='col'>");
                echo ($row["Field"]);
                echo ("</th>");
            }
            echo ('
                    </thead>
                    <tbody>');
            $query = "SELECT * FROM " . $_POST['selectTable'] . ";";
            $result = $conn->query($query);
            while ($row = mysqli_fetch_row($result)) {
                echo ("<tr>");
                foreach ($row as $item) {
                    echo ('<td>' . $item . '</td>');
                }
                echo ("</tr>");
            }
            echo ('</tbody></table>');
            echo ('</div >');
            echo ('</div >');

        }

        ?>
    </div>

</body>

</html>