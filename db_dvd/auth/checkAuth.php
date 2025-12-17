<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(dirname(__DIR__) . '/config.php');
require_once("dbKit.php");
$DB = ConnectToDB();

if (!isset($_SESSION['SessionID']) && isset($_COOKIE['remember_token'])) {

    $FetchUserData = $DB->prepare("SELECT CodTessera,SessionID  FROM tblClienti WHERE SessionID = ?");
    $FetchUserData->bind_param("s", $_COOKIE['remember_token']);
    $FetchUserData->execute();
    $FetchedUser = $FetchUserData->get_result();
    $user = $FetchedUser->fetch_assoc();
    if ($FetchedUser->num_rows !== 0) {
        $_SESSION['CodTessera'] = $user['CodTessera'];
        $_SESSION['SessionID'] = $user['SessionID'];
    }
}


if (!isset($_SESSION['SessionID'])) {
    header("Location: " . BASE_PATH . "/index.php");
    exit();
}

$FetchUserData = $DB->prepare("SELECT CodTessera, Nome, Cognome FROM tblClienti WHERE SessionID = ?");
$FetchUserData->bind_param("s", $_SESSION['SessionID']);
$FetchUserData->execute();
$FetchedUser = $FetchUserData->get_result();

if ($FetchedUser->num_rows === 0) {
    session_destroy();
    header("Location: " . BASE_PATH . "/index.php");
    exit();
}

$User = $FetchedUser->fetch_assoc();
$_SESSION['CodTessera'] = $User['CodTessera'];
$_SESSION['Nome'] = $User['Nome'];
$_SESSION['Cognome'] = $User['Cognome'];
?>