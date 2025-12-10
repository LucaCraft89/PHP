<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once(dirname(__DIR__) . '/config.php');
require_once("dbKit.php");
$conn = ConnectToDB();

try {
    $stmt = $conn->prepare(
        "INSERT INTO tblClienti 
        (Cognome, Nome, Via, NumCivico, Citta, Telefono, DataEmissioneTessera, password, SessionID)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $void_session = "";

    $stmt->bind_param(
        "sssisisss",
        $_POST["cognome"],
        $_POST["nome"],
        $_POST["via"],
        $_POST["numcivico"],
        $_POST["citta"],
        $_POST["telefono"],
        $_POST["dataemissionetessera"],
        $pass,
        $void_session
    );

    if ($stmt->execute()) {
        $_SESSION['registration_success'] = "Registrazione completata con successo! Ora puoi accedere.";
        header("Location: " . BASE_PATH . "/index.php");
        exit();
    } else {
        throw new Exception("Errore durante la registrazione: " . $stmt->error);
    }
} catch (Exception $e) {
    $_SESSION['registration_error'] = "Errore: " . $e->getMessage();
    header("Location: " . BASE_PATH . "/auth/register_form.php");
    exit();
}
?>