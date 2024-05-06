function aggiungi() {
    console.log("Funzione aggiungi() chiamata."); // Aggiunto per il debug
    document.getElementById("tabella-dati").classList.remove("hidden");
    var button = document.querySelector(".aggiungi");
    button.style.textAlign = "left"; // Imposta l'allineamento a sinistra per il bottone "AGGIUNGI"
    button.style.width = "fit-content"; // Imposta la larghezza del bottone in base al testo
    button.style.marginRight = "auto"; // Sposta il bottone a sinistra
}


function registraDati() {
    console.log("Funzione registraDati() chiamata."); // Per il debug

    // Ottenere i valori dai campi di input
    var nome = document.getElementById("nome").value;
    var posti = document.getElementById("posti").value;
    var via = document.getElementById("via").value;
    var civico = document.getElementById("civico").value;
    var paese = document.getElementById("paese").value;
    var cap = document.getElementById("cap").value;
    var telefono = document.getElementById("telefono").value;

    // Output dei valori per il debug
    console.log("Nome:", nome);
    console.log("Posti:", posti);
    console.log("Via:", via);
    console.log("Civico:", civico);
    console.log("Paese:", paese);
    console.log("CAP:", cap);
    console.log("Telefono:", telefono);

    // Creare un nuovo elemento div per il riepilogo dei dati
    var riepilogoDiv = document.createElement("div");
    riepilogoDiv.classList.add("riepilogo");

    // Costruire il riepilogo dei dati
    riepilogoDiv.innerHTML = `
        <h2>Ristorante: ${nome}</h2>
        <p><strong>Nome:</strong> ${nome}</p>
        <p><strong>Posti:</strong> ${posti}</p>
        <p><strong>Via:</strong> ${via}</p>
        <p><strong>Civico:</strong> ${civico}</p>
        <p><strong>Paese:</strong> ${paese}</p>
        <p><strong>CAP:</strong> ${cap}</p>
        <p><strong>Numero di Telefono:</strong> ${telefono}</p>
    `;

    // Aggiungere il riepilogo dei dati al contenitore principale
    var riepilogoContainer = document.getElementById("riepilogo-container");
    riepilogoContainer.appendChild(riepilogoDiv);

    // Nascondere la tabella per l'inserimento dei dati dopo aver registrato i dati
    document.getElementById("tabella-dati").classList.add("hidden");

    // Svuotare i campi di input per il prossimo inserimento
    document.getElementById("nome").value = "";
    document.getElementById("posti").value = "";
    document.getElementById("via").value = "";
    document.getElementById("civico").value = "";
    document.getElementById("paese").value = "";
    document.getElementById("cap").value = "";
    document.getElementById("telefono").value = "";

    // Aggiunta del riepilogo alla riga corrente
    var riepilogoRow = document.querySelector('.riepilogo-row');

    // Aggiungi il riepilogo al riepilogoRow corrente
    riepilogoRow.appendChild(riepilogoDiv);
}

const inputPaese = document.getElementById('inputPaese');
const suggerimentiPaese = document.getElementById('suggerimentiPaese');



// Funzione per inviare una richiesta AJAX al server e ottenere i suggerimenti
function ottieniSuggerimenti() {
    const valoreInput = inputPaese.value.trim();
    if (valoreInput.length === 0) {
        suggerimentiPaese.innerHTML = '';
        return;
    }

    // Invia una richiesta POST al server per ottenere i suggerimenti
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'suggerimenti_paese.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const suggerimenti = JSON.parse(xhr.responseText);
            mostraSuggerimenti(suggerimenti);
        }
    };
    xhr.send('query=' + encodeURIComponent(valoreInput));
}

// Funzione per mostrare i suggerimenti all'utente
function mostraSuggerimenti(suggerimenti) {
    suggerimentiPaese.innerHTML = '';
    suggerimenti.forEach(function (suggerimento) {
        const suggerimentoElemento = document.createElement('div');
        suggerimentoElemento.textContent = suggerimento;
        suggerimentoElemento.classList.add('suggerimento');
        suggerimentoElemento.addEventListener('click', function () {
            inputPaese.value = suggerimento;
            suggerimentiPaese.innerHTML = '';
        });
        suggerimentiPaese.appendChild(suggerimentoElemento);
    });
}

// Aggiungi un gestore degli eventi per l'evento di input
inputPaese.addEventListener('input', ottieniSuggerimenti);

// Aggiunta in aggiuntaLocale.js

document.getElementById("inputPaese").addEventListener("input", function() {
    var input = this.value.trim(); // Rimuovi spazi vuoti all'inizio e alla fine
    var suggerimentiDiv = document.getElementById("suggerimentiPaese");
    suggerimentiDiv.innerHTML = "";

    fetch("suggerimenti_paese.php?q=" + input)
        .then(response => response.json())
        .then(data => {
            data.forEach(suggerimento => {
                var suggerimentoDiv = document.createElement("div");
                suggerimentoDiv.textContent = suggerimento.nome; // Visualizza solo il nome del paese
                suggerimentoDiv.dataset.id = suggerimento.id; // Imposta l'id del paese come attributo dataset
                suggerimentoDiv.classList.add("suggerimento");
                suggerimentoDiv.addEventListener("click", function() {
                    document.getElementById("inputPaese").value = this.textContent;
                    document.getElementById("idPaese").value = this.dataset.id; // Imposta l'id del paese nell'input nascosto
                    suggerimentiDiv.innerHTML = "";
                });
                suggerimentiDiv.appendChild(suggerimentoDiv);
            });
        });
});



