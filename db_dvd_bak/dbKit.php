<?php
    function ConnectToDB() {
        $host = 'localhost';
        $username = 'lucatruant';
        $password = "rauscedo";
        $database = "dvd";
        $DB = mysqli_connect($host, $username, $password, $database);
        if ($DB == null) {
            die("impossibile connettersi al DBMS :(");
        } else{
            return $DB;
        }

    }
?>