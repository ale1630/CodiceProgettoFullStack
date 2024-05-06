<?php
session_start();
require_once "database.php";

if (isset($_GET['idPrenotazione'])) {
    $idPrenotazione = $_GET['idPrenotazione'];

    // Esegui la query per eliminare la prenotazione
    $sqlCancella = "DELETE FROM prenota WHERE id = $idPrenotazione";
    if ($conn->query($sqlCancella) === TRUE) {
        echo "Prenotazione cancellata con successo.";
    } else {
        echo "Errore durante la cancellazione della prenotazione: " . $conn->error;
    }
} else {
    echo "ID prenotazione non fornito.";
}

// Chiudi la connessione al database
$conn->close();
?>
