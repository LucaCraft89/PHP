<?php
    require_once("dbKit.php");
    $DB = ConnectToDB();
    $RentalID = (int)$_GET['id'];
    $RemoveRental = $DB->prepare("DELETE FROM tblNoleggi WHERE CodNoleggio = ?");
    $RemoveRental->bind_param("i", $RentalID);
    $RemoveRental->execute();
    header("Location: index.php");
?>