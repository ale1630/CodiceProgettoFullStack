<?php
session_start();
// Connessione al database
require_once "../database.php";

// Query per recuperare i paesi dalla tabella
$sql = "SELECT * FROM paese";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi il tuo locale</title>
    <link rel="stylesheet" href="../css/aggiuntaLocale.css">
    <style>
        /* Stile per i campi di input */
        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="file"] {
            width: 300px; /* Larghezza fissa per tutti gli input */
            height: 30px; /* Altezza fissa per tutti gli input */
            padding: 5px; /* Padding uniforme per tutti gli input */
        }

        /* Stile per il contenitore dei suggerimenti */
        #suggerimentiPaese {
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            z-index: 9999;
            width: calc(100% - 22px); /* Larghezza uguale a quella del campo di input */
            margin-top: 5px; /* Spazio sopra i suggerimenti */
            padding: 5px; /* Padding uniforme per i suggerimenti */
        }

        /* Stile per i suggerimenti */
        #suggerimentiPaese ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #suggerimentiPaese ul li {
            padding: 5px 10px;
            cursor: pointer;
        }

        #suggerimentiPaese ul li:hover {
            background-color: #f4f4f4;
        }
                /* Stile per il contenitore dei suggerimenti */
                #suggerimentiPaese {
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            z-index: 9999;
            width: calc(100% - 22px);
            padding: 5px;
            top: calc(100% + 5px); /* Posiziona il div dei suggerimenti sotto l'input */
            left: 0; /* Allinea il div dei suggerimenti a sinistra */
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Aggiunge un'ombra al div */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container pl-0">
            <strong>
                <h3>
                    <center>THE FORK </center>
                </h3>
            </strong>
        </div>
    </nav>

    <!-- FORM per l'inserimento dei dati -->
    <center>
        <h1><b>AGGIUNGI IL TUO LOCALE!</b></h1>

        <form action="../index.php">
            <input type="submit" class="home" id="inputAggiungi" value="home">
        </form>

        <br>

        <form action="../creazione_locale.php" method="post" class="formAggiungiLocale" enctype="multipart/form-data">
            <!-- todo: METTERE LA PAGINA DI ACTION-->

            <input type="text" id="inputAggiungiLocali" name="reg_nome" placeholder="Nome locale"><br><br>

            <input type="number" id="inputAggiungiLocali" name="reg_numero_posti" placeholder="Numero posti"><br><br>

            <input type="text" id="inputAggiungiLocali" name="reg_via" placeholder="Via"><br><br>

            <input type="text" id="inputAggiungiLocali" name="reg_numero_civico" placeholder="Numero civico"><br><br>
            <input type="text" id="inputAggiungiLocali" name="reg_pranzo" placeholder="Esempio: 9:00 alle 13:00"><br><br>
            <input type="text" id="inputAggiungiLocali" name="reg_cena" placeholder="Esempio: 18:00 alle 23:00"><br><br>

            <input type="text" id="inputPaese" name="reg_paese" placeholder="Cerca paese">
            <div id="suggerimentiPaese" style="width: 100px;"></div>
            <input type="hidden" id="idPaese" name="reg_id_paese">

            <br><br>
            <textarea class="form-control altezza" id="reg_descrizione" name="reg_descrizione_i" placeholder="Descrizione Interna" required></textarea>
            <br><br>
            <textarea class="form-control altezza" id="reg_descrizione" name="reg_descrizione_e" placeholder="Descrizione Esterna" required></textarea>
            <br><br>


            <input type="tel" id="inputAggiungiLocali" name="reg_telefono" placeholder="Numero di Cellulare"><br><br>
            <input type="file" class="form-control" id="reg_immagine" name="reg_immagine" accept="image/*" required> <br>

            <input type="submit" id="inputAggiungi" value="Aggiungi">
            <br>
        </form>
    </center>

    <script src="aggiuntaLocale.js"></script>
    <script>
        // Funzione per ottenere i suggerimenti
// Funzione per ottenere i suggerimenti e impostare l'ID del paese
function getSuggerimenti(query) {
    // Effettua una richiesta AJAX al file PHP
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Riceve i suggerimenti e li mostra nella div apposita
            document.getElementById("suggerimentiPaese").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "suggerimenti_paese.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("query=" + query);
}

// Funzione per gestire la selezione del paese
function selezionaPaese(id, nome) {
    // Imposta l'ID del paese nel campo nascosto
    document.getElementById("idPaese").value = id;
    // Imposta il nome del paese nell'input di ricerca
    document.getElementById("inputPaese").value = nome;
    // Pulisce i suggerimenti
    document.getElementById("suggerimentiPaese").innerHTML = "";
}


        // Funzione per gestire l'input dell'utente
        document.getElementById("inputPaese").addEventListener("input", function () {
            var query = this.value.trim(); // Ottiene la query di ricerca
            if (query.length >= 3) { // Assicura che la query sia lunga almeno 3 caratteri
                getSuggerimenti(query); // Ottiene i suggerimenti
            } else {
                document.getElementById("suggerimentiPaese").innerHTML = ""; // Pulisce i suggerimenti se la query è troppo breve
            }
        });
    </script>
</body>

</html>

