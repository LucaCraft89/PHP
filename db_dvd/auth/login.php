<?php
session_start();
require_once(dirname(__DIR__) . '/config.php');
require_once("dbKit.php");
$DB = ConnectToDB();

if (!isset($_SESSION['SessionID']) && isset($_POST['pass']) && isset($_POST['phone'])) {
    $phone = (int) $_POST['phone'];
    $pass = $_POST['pass'];
    $remember = $_POST['ricordami'];
    //check auth
    $FetchUserData = $DB->prepare("SELECT password, Nome, Cognome, CodTessera FROM tblClienti WHERE Telefono = ?");
    $FetchUserData->bind_param("i", $phone);
    $FetchUserData->execute();
    $FetchedUser = $FetchUserData->get_result();

    $authenticated = false;
    while ($User = $FetchedUser->fetch_assoc()) {
        if (password_verify($pass, $User['password'])) {
            $SessionID = bin2hex(random_bytes(256)); //str sicura random
            $expires = date("Y-m-d H:i:s", time() + 60 * 60 * 24 * 30); // 30 giorni

            $_SESSION['SessionID'] = $SessionID;
            $_SESSION['Nome'] = $User['Nome'];
            $_SESSION['Cognome'] = $User['Cognome'];
            $_SESSION['CodTessera'] = $User['CodTessera'];
            $_SESSION['Telefono'] = $phone;
            $_SESSION['Ricordami'] = $_POST['ricordami'];
            if ($_SESSION['Ricordami']=== "1") {
                setcookie(
                    "remember_token",
                    $_SESSION['SessionID'],
                    time() + 60 * 60 * 24 * 30,
                    "/",
                    "",
                    false,
                    true // HttpOnly
                );
            }


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