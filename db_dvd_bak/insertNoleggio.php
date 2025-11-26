<?php
    require_once("dbKit.php");
    $DB = ConnectToDB();
    // Controlla che tutti i campi siano presenti
if (
    isset($_POST['id']) &&
    isset($_POST['CodDVD']) &&
    isset($_POST['DataNoleggio']) &&
    isset($_POST['DataScadenza']) &&
    isset($_POST['TariffaGiornaliera'])
) {
    // 🔹 Ottieni le variabili dal form
    $CodTessera = intval($_POST['id']);
    $CodDvd = intval($_POST['CodDVD']);
    $DataNoleggio = $_POST['DataNoleggio'];
    $DataScadenza = $_POST['DataScadenza'];
    $TariffaGiornaliera = floatval($_POST['TariffaGiornaliera']);

    // 🔹 Prepara la query SQL per l’inserimento
    $stmt = $DB->prepare("
        INSERT INTO tblNoleggi (CodTessera, CodDvd, DataNoleggio, DataScadenza, TariffaGiornaliera)
        VALUES (?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param("iissd", $CodTessera, $CodDvd, $DataNoleggio, $DataScadenza, $TariffaGiornaliera);

        if ($stmt->execute()) {
            header("Location: index.php");
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