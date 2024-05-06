<?php
session_start();
require_once "database.php";

// Inizializza $username come vuoto se $_SESSION['username'] non è definito
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Variabili per l'immagine
$imgSrc = "";
$localeName = "";
$localeDescription = "";
$localeAddress = "";
$localePhone = "";
$localeLunchHours = "";
$localeDinnerHours = "";

// Verifica se l'ID del locale è stato passato come parametro nella URL
if (isset($_GET['id'])) {
    $locale_id = $_GET['id'];

    // Query per recuperare i dettagli del locale dal database
    $sql = "SELECT * FROM locale WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $locale_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se il locale esiste, popola le variabili con i suoi dettagli
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Converti i dati binari dell'immagine in base64
        $imgData = base64_encode($row["img"]);
        $imgSrc = 'data:image/jpeg;base64,' . $imgData;
        $localeName = $row["nome"];
        $localeDescription = $row["descrizione_interna"];
        $localeAddress = "Via " . $row["via"] . ", " . $row["civico"] . ", 07026 Pittulongu, Olbia";
        $localePhone = $row["telefono"];
        $localeLunchHours = $row["pranzo"];
        $localeDinnerHours = $row["cena"];
    } else {
        echo "Locale non trovato";
    }
} else {
    echo "ID del locale non fornito nella URL";
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dettagli_locale.css">
    <title>Dettaglio locale</title>
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-title pl-0">
            <strong><h3>THE FORK</h3></strong>
        </div>
    </nav> -->
    <br><br>
    <div class="container">
        <div class='restaurant-info'>
            <h2><?php echo $localeName; ?></h2>
            <img src='<?php echo $imgSrc; ?>' alt='Immagine del ristorante'>
        </div>
        <div class="info-container">
            <div class="descrizione">
                <h3>Descrizione:</h3>
                <p><?php echo $localeDescription; ?></p>
            </div>
            <div class="doveSiamo">
                <h3>Dove ci troviamo:</h3>
                <div class="map-container">
                    <iframe src="https://maps-cdn.site123.com/include/globalMapDisplay.php?q=Via Mar Adriatico, 34 ,07026 Pittulongu, Olbia Sardegna, Italy&amp;z=15&amp;l=it&amp;ilfc=" 
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class='contatti'>
                    <p><b>Indirizzo: </b><?php echo $localeAddress; ?></p>
                    <p><b>Telefono:</b><?php echo $localePhone; ?></p>
                    <p><b>Orari:</b> Siamo aperti tutti i giorni dalle <?php echo $localeLunchHours; ?> e dalle <?php echo $localeDinnerHours; ?>.</p>
                </div>
            </div>
            <div class="btnContainer">
                <form action="javascript:history.back()">
                    <button type="submit" class="btnIndietro">INDIETRO</button>
                </form>
                <button type="button" class="btnPrenota" onclick="prenota()">PRENOTA</button>
            </div>
        </div>
    </div>
</body>
</html>
