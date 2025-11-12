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
            <h2>Search <b>agente</b> on vendite JOIN clienti, modelli</h2>
            <div class="mb-3">
                <label for="agente" class="form-label">agente</label>
                <input required name="agente" type="text" class="form-control" id="agente">
            </div>
            <button name="submit-search" type="submit" class="btn btn-primary w-100" onclick="this.form.submit(); 
             ">Search</button>
        </form>
    </div>
    <?php
    if (isset($_POST['submit-search'])) {
        echo ('<div class="mx-4 mt-2 d-flex my-auto justify-content-center ">');
        echo ('<div class="table-responsive">');
        echo ('<table class="table table-dark">
                    <thead>
                        ');

            $query = "
                CREATE TEMPORARY TABLE temp AS(
                SELECT *
                FROM vendite
                JOIN clienti ON vendite.cliente = clienti.idCliente
                JOIN modelli ON vendite.modello = modelli.idMod
                WHERE agente LIKE CONCAT('%', '" . $_POST['agente'] . "', '%'));";
            $result = $conn->query($query);



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