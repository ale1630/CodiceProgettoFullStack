<?php
session_start();
require_once "database.php";

$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

// Se $nome è definito, recupera i dettagli dell'utente
if ($email) {
    // Query per recuperare i dettagli dell'utente
    $sql_utente = "SELECT * FROM cliente WHERE email = ?";
    $stmt_utente = $conn->prepare($sql_utente);
    $stmt_utente->bind_param("s", $email);
    $stmt_utente->execute();
    $result_utente = $stmt_utente->get_result();

    // Se l'utente esiste, mostra il saluto
    if ($result_utente->num_rows > 0) {
        $row_utente = $result_utente->fetch_assoc();
        $saluto = "Ciao " . $row_utente["nome"];
    } else {
        $saluto = "Ciao " . $email;
    }
}

// Recupera tutte le ricette indipendentemente dall'autenticazione dell'utente
$sql_locale = "SELECT * FROM locale";
$stmt_locale = $conn->prepare($sql_locale);
$stmt_locale->execute();
$result_locale = $stmt_locale->get_result();
?>

<!DOCTYPE html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista Locali</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/listaLocali.css">
        <style>
            .btnPersonale{
            align-items: center;
            padding: 10px 100px;
            font-size: 16px;
            background-color: rgb(95, 171, 224);; /* Colore di sfondo del pulsante */
            color: #fff; /* Colore del testo del pulsante */
            border: none;
            border-radius: 5px;
            }
            .card-img-top {
                height: 200px; /* Altezza desiderata */
                object-fit: cover; /* Per mantenere le proporzioni dell'immagine */
            }

        </style>
    </head>
    <body>
        <!-- <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container pl-0">
                <strong><h3>THE FORK</h3></strong>
            </div>
        </nav> -->

        
        <div class="container-fluid contact py-5" style="background-image: url('images/porto.jpg'); background-size: cover; background-position: center;">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style mb-4">
                        <h4 class="sub-title  text-center  text-white mb-0">I nostri locali</h4>
                    </div>
                    <p class="mb-0 text-white text-center fs-5">          
                        Scopri il locale più adatto a te e prenota una cena da sogno!
                        <br>   
                    </p>
                </div>
            </div>
        </div>
    <br><br>
        <div class='areaPersonale d-flex justify-content-center'>
            <a type='button' class='btnPersonale' href='login.html'>ENTRA NELLA TUA AREA PERSONALE</a>
        </div>
    <br><br>








        
<div class="container">
    <div class='row'>
        <?php
        // Cicla attraverso i risultati del database e mostra le ricette
        while ($row = $result_locale->fetch_assoc()) {
            // Converti i dati binari dell'immagine in base64
            $imgData = base64_encode($row["img"]);
            $imgSrc = 'data:image/jpeg;base64,' . $imgData; // Assumendo che le immagini siano in formato JPEG, modifica se necessario

            echo "
            <div class='col-12 col-md-4 mb-4'>
                <div class='card h-100'>
                    <img src='".$imgSrc."' class='card-img-top' alt=''>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title'>".$row["nome"]."</h5>
                        <p class='card-text'>".$row["descrizione_esterna"]."</p>
                        <div class='mt-auto'>
                            <a href='dettagli_locale.php?id=" . $row["id"] . "' class='btn btn-primary'>Dettagli</a>
                        </div>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</div>


    
<!-- <footer class="footer mt-auto py-3">
    <div class="container">
        
    </div>
</footer> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>