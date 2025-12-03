<?php
session_start();
require_once(dirname(__DIR__) . '/config.php');
require_once("dbKit.php");
$DB = ConnectToDB();

if (isset($_SESSION['SessionID'])) {
    $emptySession = "";
    $ClearSession = $DB->prepare("UPDATE tblClienti SET SessionID = ? WHERE SessionID = ?");
    $ClearSession->bind_param("ss", $emptySession, $_SESSION['SessionID']);
    $ClearSession->execute();
}

session_unset();
session_destroy();

header("Location: " . BASE_PATH . "/index.php");
exit();
?>