<?php
session_start();
require_once "database.php";

if (isset($_GET['idPrenotazione'])) {
    $idPrenotazione = $_GET['idPrenotazione'];

    // Esegui la query per aggiornare lo stato della prenotazione
    $sqlAccetta = "UPDATE prenota SET accettata = 1 WHERE id = $idPrenotazione";
    if ($conn->query($sqlAccetta) === TRUE) {
        echo "Prenotazione accettata con successo.";
    } else {
        echo "Errore durante l'accettazione della prenotazione: " . $conn->error;
    }
} else {
    echo "ID prenotazione non fornito.";
}

// Chiudi la connessione al database
$conn->close();
?>
