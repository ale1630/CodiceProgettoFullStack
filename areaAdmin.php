<?php
session_start();
require_once "database.php";

// Verifica se l'utente è loggato
if (!isset($_SESSION['codiceOperatore'])) {
    // L'utente non è loggato, reindirizzalo alla pagina di accesso
    header("Location: loginAdmin.html");
    exit; // Assicura che lo script termini qui
}

// Recupera il codice operatore dall'array di sessione
$codiceOperatore = $_SESSION['codiceOperatore'];

// Query per ottenere l'idLocale dell'admin loggato
$sqlIdLocale = "SELECT idLocale FROM admin WHERE codiceOperatore = '$codiceOperatore'";
$resultIdLocale = $conn->query($sqlIdLocale);

// Verifica se la query ha restituito risultati
if ($resultIdLocale->num_rows > 0) {
    // Estrai l'idLocale dalla riga risultante
    $rowIdLocale = $resultIdLocale->fetch_assoc();
    $idLocale = $rowIdLocale['idLocale'];

    // Query per selezionare tutti i dati dalla tabella prenota con accettata uguale a 0 e idLocale uguale a $idLocale
    $sql = "SELECT * FROM prenota WHERE accettata = 0 AND idLocale = $idLocale";

    // Esegui la query
    $result = $conn->query($sql);

    // Verifica se ci sono risultati
    if ($result->num_rows > 0) {
        // Cicla attraverso i risultati e stampa ogni riga
        while ($row = $result->fetch_assoc()) {
            $idPrenotazioneArray[] = $row["id"];
            $mailPrenotazioneArray[] = $row["mailPrenotazione"];
            $numeriPostiArray[] = $row["numeroPosti"];
            $dataArray[] = $row["data"];
            $idTurnoArray[] = $row["idTurno"];
        }
    } else {
        echo "Nessun risultato trovato nella tabella prenota per idLocale = $idLocale e accettata = 0";
    }
} else {
    echo "Nessun idLocale associato all'admin con codice operatore: $codiceOperatore";
}

// Chiudi la connessione al database
$conn->close();
?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area ristoratore</title>
    <link rel="stylesheet" href="areaAdmin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container pl-0">
            <strong>
                <h3>
                    THE FORK 
                </h3>
            </strong>
        </div>
    </nav>

    <center>
        <h1> CIAO <?php echo $codiceOperatore?> SEI NELL'AREA RISTORATORE! <h1>
    </center>


<div class="container my-2">
    <div class="row justify-content-around">
        <?php
        // Cicla attraverso i dati della prenotazione e mostra ciascuna prenotazione
        for ($i = 0; $i < count($idPrenotazioneArray); $i++) {
            echo '<div class="col-12 col-sm-6 col-md-4 mt-3">
                    <div class="card card-cibo">
                        <div class="card-body">
                            <h5 class="card-title">ID Prenotazione: ' . $idPrenotazioneArray[$i] . '</h5>
                            <p class="card-text"> Email Prenotazione: ' . $mailPrenotazioneArray[$i] . '</p>
                            <p class="card-text"> Posti Prenotati: ' . $numeriPostiArray[$i] . '</p>
                            <p class="card-text"> Data Prenotazione: ' . $dataArray[$i] . '</p>
                            <p class="card-text"> turno: ' . $idTurnoArray[$i] . '</p>
                            <a class="btn btn-primary my-1" href="accetta_prenotazione.php?idPrenotazione=<?php echo $idPrenotazioneArray[$i]; ?>">Accetta Prenotazione</a>
                            <a class="btn btn-danger my-1" href="cancella_prenotazione.php?idPrenotazione=<?php echo $idPrenotazioneArray[$i]; ?>">Rifiuta Prenotazione</a>                            
                            ';
                        echo '</div>
                    </div>
                </div>';
        }
        ?>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
