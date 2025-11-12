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
            <h2>Join <b>vendite</b> with</h2>
            <div class="mb-3">
                <select required id="selectTable<?php echo($i)?>" name="selectTable" class="form-select" aria-label="Default select example">
                    <option selected disabled">Select Table</option>
                    <?php
                    $query = "SHOW TABLES;";
                    $result = $conn->query($query);
                    while ($row = mysqli_fetch_array($result)) {
                        if($row['Tables_in_' . $dbName]=="vendite"){
                            continue;
                        }
                        echo ("<option value='" . $row['Tables_in_' . $dbName] . "'>");
                        echo ($row['Tables_in_' . $dbName]);
                        echo ("</option>");
                    }
                    ?>
                </select>
            </div>
             <button name="submit-join" type="submit" class="btn btn-primary w-100" onclick="this.form.submit(); 
             ">Join</button>
        </form>
    </div>
        <?php
        if (isset($_POST['submit-join'])) {
            echo ('<div class="mx-4 mt-2 d-flex my-auto justify-content-center ">');
echo ('<div class="table-responsive">');
            echo ('<table class="table table-dark">
                    <thead>
                        ');
            if($_POST['selectTable'] == "clienti"){
                $query = "CREATE TEMPORARY TABLE temp AS (SELECT * FROM vendite JOIN clienti ON vendite.cliente = clienti.idCliente);";
                $result = $conn->query($query);
            }
            else if ($_POST['selectTable'] == "modelli") {
                $query = "CREATE TEMPORARY TABLE temp AS (SELECT * FROM vendite JOIN modelli ON vendite.modello = modelli.idMod);";
                $result = $conn->query($query);
            } else {
                echo("NO VALID TABLE SELECTED");
                die();
            }


            $query = "DESCRIBE temp;";
            $result = $conn->query($query);


            while ($row = mysqli_fetch_array($result)) {
                echo ("<th scope='col'>");
                echo ($row["Field"]);
                echo ("</th>");
            }
            echo ('
                    </thead>
                    <tbody>');
            $query = "SELECT * FROM temp;";
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
            $query = "DROP TABLE temp;";
            $result = $conn->query($query);
        }

        ?>
    </div>

</body>

</html>