<?php
require_once("auth/checkAuth.php");
require_once("config.php");
require_once("dbKit.php");
$DB = ConnectToDB();
$RentalID = (int) $_GET['id'];
$RemoveRental = $DB->prepare("DELETE FROM tblNoleggi WHERE CodNoleggio = ?");
$RemoveRental->bind_param("i", $RentalID);
$RemoveRental->execute();
header("Location: " . BASE_PATH . "/menu.php");
?>