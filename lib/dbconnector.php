<?php
function dBConnection($dbHost, $dbUsr, $dbPass, $dbName) {

    $conn = new mysqli(($dbHost=="") ? "localhost" : $dbHost, ($dbUsr=="") ? "root" : $dbUsr, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("DB Conn Failed: " . mysqli_connect_error());
    } else {
        echo (
            "<script>
        console.log('DB Connection succeded');
    </script>"
        );
    }
    return $conn;
}
?>
