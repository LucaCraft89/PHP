<?php
session_start();
require_once(dirname(__DIR__) . '/config.php');
require_once("dbKit.php");
$DB = ConnectToDB();

if (!isset($_SESSION['SessionID']) && isset($_POST['pass']) && isset($_POST['phone'])) {
    $phone = (int) $_POST['phone'];
    $pass = $_POST['pass'];

    //check auth
    $FetchUserData = $DB->prepare("SELECT password, Nome, Cognome, CodTessera FROM tblClienti WHERE Telefono = ?");
    $FetchUserData->bind_param("i", $phone);
    $FetchUserData->execute();
    $FetchedUser = $FetchUserData->get_result();

    $authenticated = false;
    while ($User = $FetchedUser->fetch_assoc()) {
        if (password_verify($pass, $User['password'])) {
            $SessionID = bin2hex(random_bytes(256)); //str sicura random
            $_SESSION['SessionID'] = $SessionID;
            $_SESSION['Nome'] = $User['Nome'];
            $_SESSION['Cognome'] = $User['Cognome'];
            $_SESSION['CodTessera'] = $User['CodTessera'];
            $_SESSION['Telefono'] = $phone;

            //metto sul db
            $UpdateSession = $DB->prepare("UPDATE tblClienti SET SessionID = ? WHERE Telefono = ?");
            $UpdateSession->bind_param("si", $SessionID, $phone);
            $UpdateSession->execute();

            $authenticated = true;
            header("Location: " . BASE_PATH . "/menu.php");
            exit();
        }
    }

    if (!$authenticated) {
        $_SESSION['login_error'] = "Numero di telefono o password non corretti";
        header("Location: " . BASE_PATH . "/index.php");
        exit();
    }
} else {
    header("Location: " . BASE_PATH . "/index.php");
    exit();
}
?>