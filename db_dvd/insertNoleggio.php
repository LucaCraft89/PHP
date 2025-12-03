<?php
require_once("auth/checkAuth.php");
require_once("config.php");
require_once("dbKit.php");
$DB = ConnectToDB();
if (
    isset($_POST['id']) &&
    isset($_POST['CodDVD']) &&
    isset($_POST['DataNoleggio']) &&
    isset($_POST['DataScadenza']) &&
    isset($_POST['TariffaGiornaliera'])
) {
    $CodTessera = intval($_POST['id']);
    $CodDvd = intval($_POST['CodDVD']);
    $DataNoleggio = $_POST['DataNoleggio'];
    $DataScadenza = $_POST['DataScadenza'];
    $TariffaGiornaliera = floatval($_POST['TariffaGiornaliera']);

    $stmt = $DB->prepare("
        INSERT INTO tblNoleggi (CodTessera, CodDvd, DataNoleggio, DataScadenza, TariffaGiornaliera)
        VALUES (?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param("iissd", $CodTessera, $CodDvd, $DataNoleggio, $DataScadenza, $TariffaGiornaliera);

        if ($stmt->execute()) {
            header("Location: " . BASE_PATH . "/menu.php");
        } else {
            echo 'errore il db si sta lagnando!';
        }

        $stmt->close();
    } else {
        echo 'errore di connessione al db';
    }

} else {
    echo 'mancano dei dati!';
}
?>