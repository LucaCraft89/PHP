<?php
require_once("../lib/head.html");
error_reporting(0);
$navName = "Show Table"
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("nav.php");
    ?>

    <main role="main" class="container py-4">
        <div class="card bg-secondary text-white shadow">
            <div class="card-body">
                <?php
                require_once("./dbKit.php");
                $DB = ConnectToDB();
                if (isset($_GET['table'])) {
                    $tableName = htmlspecialchars($_GET['table']);
                    echo '<h3 class="mb-4"><i class="bi bi-table"></i> Tabella: ' . $tableName . '</h3>';

                    //fetch titoli colonne
                    $ColumnNamesQuery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ?";
                    $stmt = $DB->prepare($ColumnNamesQuery);
                    $stmt->bind_param("s", $_GET['table']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    echo '<div class="table-responsive">';
                    echo '<table class="table table-dark table-striped table-hover">';
                    echo '<thead class="table-primary">';
                    echo '<tr>';
                    $ColumnTitles = [];
                    $TotalColumns = 0;
                    while ($row = $result->fetch_assoc()) {
                        echo '<th scope="col">' . ($row['COLUMN_NAME']) . '</th>';
                        array_push($ColumnTitles, $row['COLUMN_NAME']);
                        $TotalColumns++;
                    }
                    echo '</tr>';
                    echo '</thead><tbody>';

                    //fetch dati colonne
                    $FetchTableContent = $DB->prepare("SELECT * FROM " . $_GET['table'] . " WHERE 1");
                    $FetchTableContent->execute();
                    $FoundData = $FetchTableContent->get_result();
                    while ($row = $FoundData->fetch_assoc()) {
                        echo ("<tr>");
                        for ($i = 0; $i < $TotalColumns; $i++) {
                            echo ("<td>" . $row[($ColumnTitles[$i])] . "</td>");
                        }
                        echo ("</tr>");
                    }
                    echo '</tbody></table>';
                    echo '</div>';
                } else {
                    header("Location: index.php");
                    exit();
                }
                ?>
            </div>
        </div>

        <div class="mt-4">
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Torna al Menu
            </a>
        </div>
    </main>
</body>

</html>