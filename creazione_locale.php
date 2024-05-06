<?php
session_start();

// Connessione al database
require_once "database.php";

// Verifica se il modulo è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal modulo
    $nome = $_POST['reg_nome'];
    $numero_posti = $_POST['reg_numero_posti'];
    $via = $_POST['reg_via'];
    $numero_civico = $_POST['reg_numero_civico'];
    $pranzo = $_POST['reg_pranzo'];
    $cena = $_POST['reg_cena'];
    $id_paese = $_POST['id_paese'];
    $descrizione_interna = $_POST['reg_descrizione_i'];
    $descrizione_esterna = $_POST['reg_descrizione_e'];
    $telefono = $_POST['reg_telefono'];

    // Controlla se un file è stato caricato e se non ci sono errori
    if (isset($_FILES['reg_immagine']) && $_FILES['reg_immagine']['error'] === UPLOAD_ERR_OK) {
        // Leggi i dati del file
        $imgData = file_get_contents($_FILES['reg_immagine']['tmp_name']);



    // Inserisci i dati nel database
    $sql = "INSERT INTO locale (civico, via, postiMax, idpaese, telefono, nome, img, descrizione_interna, descrizione_esterna,pranzo,cena) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiisssssss", $numero_civico, $via, $numero_posti, $id_paese, $telefono, $nome, $imgData, $descrizione_interna, $descrizione_esterna,$pranzo,$cena);

    if ($stmt->execute()) {
        // Redirect alla pagina di successo
        header("Location: index.php");
        exit();
    } else {
        // Redirect alla pagina di errore
        header("Location: errore.php");
        exit();
    }
}

    // Chiudi la connessione
    $stmt->close();
    $conn->close();
}
?>
