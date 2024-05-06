<?php
session_start();
require_once "database.php";

$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

// Se $email è definito, recupera i dettagli dell'utente
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
        $ruolo = "Utente normale"; // Definisci $ruolo per gli utenti normali
    } else {
        $saluto = "Ciao " . $email;
        $ruolo = "Utente normale";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE FORK</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #28a745; /* verde */
        }
        .navbar-title {
            font-size: 50px; /* Dimensione del testo desiderata */
            font-weight: bold; /* Rendi il testo in grassetto, se necessario */
        }
        .footer {
            background-color: #28a745; /* verde */
        }
        .home-image-container {
            position: relative;
            text-align: center;
        }
        .home-image-container img {
            width: 100%; /* Assicura che l'immagine occupi tutto lo spazio disponibile */
            height: 700px;
        }
        .home-image-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 55px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Ombra per migliorare la leggibilità */
        }
        .container-fluid{
            background-color: rgba(91, 160, 59, 0.365);
            border-radius: 10px;
            max-width: 1500px; /* Larghezza massima del container */
            margin: 0 auto; /* Margini automatici per centrare il container */
            padding: 20px; /* Padding per il contenuto all'interno del container */
        }
        .scritta {
            font-size: 40px; /* Modifica la dimensione del testo */
            font-weight: bold; /* Rendi il testo in grassetto */
            text-align: center;
            color: #28a745;
            margin-top: 50px; /* Aggiungi un margine superiore per spaziare dalla riga precedente */
        }
        .gifCardContainer {
            margin-top: 50px; /* Aggiungi spazio sopra la gif card */
        }

        .gifCard {
            width: 100%; /* Assicura che l'immagine occupi tutto lo spazio disponibile */
            height: 400px;
        }

        .text-align {
            text-align: left; /* Posiziona il testo e il pulsante a sinistra */
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand navbar-title" href="#">THE FORK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="chiSiamo.php">Chi siamo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.instagram.com/thefork_it/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://www.facebook.com/groups/1138441923824246">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contatti.html">Contatti</a>
            </li>
        </ul>
        <div class="my-2 my-lg-0">
            <?php if (isset($_SESSION['email'])): ?>
                <span class="text-light mr-3"><?php echo $saluto; ?></span>
                <a href="locali.php" class="btn btn-outline-light my-2 my-sm-0">I Nostri Locali</a>
                <button id="logoutButton" class="btn btn-outline-light my-2 my-sm-0">Logout</button>
            <?php else: ?>
                <a class="btn btn-outline-light my-2 my-sm-0" href="login.html">Accedi</a>
            <?php endif; ?>
        </div>
    </div>
</nav>


    <!-- Immagine con testo sopra -->
    <div class="home-image-container">
        <img src="images/sfondoHome.jpg" alt="Descrizione dell'immagine">
        <div class="home-image-text">THE FORK</div>
    </div>
    <BR><BR>
    <!-- servizi -->
    <h3 class="scritta">I NOSTRI SERVIZI <HR></h3>
<div class="container-fluid mt-3">
    <br><br>
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="p-3 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                </svg><br><br>
                <h5 class="text-dark">Registrare il tuo ristorante</h5>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="p-3 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                    <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                </svg><br><br>
                <h5 class="text-dark">Prenotare il tuo ristorante preferito</h5>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="p-3 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16">
                    <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                </svg><br><br>
                <h5 class="text-dark">Sconti vantaggiosi</h5>
            </div>
        </div>
    </div>
</div>
<br><br>
<!-- gifCard -->
<div class="gifCardContainer container text-center">
    <div class="row align-items-center">
        <div class="col-md-6">
            <img class="gifCard" src="images/gifCard.jpeg">
        </div>
        <div class="col-md-6 text-center">
            <h4>Scopri le nuove Gift Card TheFork</h4><br>
            <button class="btn btn-success">ACQUISTA ORA</button>
        </div>
    </div>
</div>
<br><br>
<!-- recensioni -->
<div class="container-reviews mt-5 text-center">
    <div class="row">
      <div class="col-md-6 newsletter-content mx-auto" style="background-color: #f5f5f5; padding: 20px; border-radius: 20px;">
        <div class="row">
          <div class="col-md-6">
            <img src="images/recensioni.png" alt="Recensioni" height="200px" width="200px" class="img-fluid" style="max-width: 450px;">
          </div>
          <div class="col-md-6">
            <h3 class="font-weight-bold">The Fork</h3>
            <p class="font-weight-bold text-muted">Recensioni</p>
            <p class="small">Valutazione di Bene</p>
            <div class="rating">
              <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
              <span class="rating-number">4.49</span>
            </div><br>
            <p class="text-muted"><a href="https://www.trustindex.io/reviews/ferramentadigrandi.it-1?lang=it">1200 recensioni</a> <i class="fas fa-check-circle text-success"></i> Verificato</p>
          </div>
        </div>
      </div>
    </div>
  </div>
<br><br>
<footer class="footer text-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <h5>Contatti</h5>
                <p>Email: theFork@assistenza.com</p>
                <p>Telefono: 011 59 5332</p>
                <p>Partita IVA: 08524070011</p>
            </div>
            <div class="col-md-4">
                <h5>Bisogno di Assistenza?</h5>
                <p><b>Telefono: </b> 011 59 5332</p>
                <p><b>Email: </b> theFork@assistenza.com</p>
            </div>
            <div class="col-md-4">
                <a href="loginAdmin.html">Accedi come Amministratore</a><br>
                <a href="/imprenditore/imprenditore.html">Accedi come Imprenditore</a>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container-fluid bg-white">
        <div class="col-auto">
            <img src="images/carta.png"  alt="Carte di credito accettate" class="img-fluid"  width="150px" height="50px">
            <img src="images/carta1.png" alt="Carte di credito accettate" class="img-fluid"  width="150px" height="50px">
            <img src="images/carta2.png" alt="Carte di credito accettate" class="img-fluid"  width="90px" height="50px">
        </div>
    </div>
    <div class="container text-center py-3">
        <hr class=" riga my-4">
        <p>The Fork &copy; 2024 All Rights Reserved 2024 P.I.08524070011 | PRIVACY POLICY | COOKIE POLICY</p>
    </div>
</footer>

    

    <!-- Bootstrap JS e dipendenze jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>