// Funzione per mostrare la tabella per l'inserimento dei dati
function aggiungi() {
    document.getElementById("tabella-dati").classList.remove("hidden");
}

// Funzione per registrare i dati e visualizzare il riepilogo
function registraDati() {
    // Aggiungi qui la logica per registrare i dati e visualizzare il riepilogo
    var tabella = document.getElementById("tabella-dati");
    tabella.classList.remove("visible"); // Rimuovi la classe visible per nascondere la tabella
}
function registraDati() {
    // Ottenere i valori dai campi di input
    var nome = document.getElementById("nome").value;
    var posti = document.getElementById("posti").value;
    var via = document.getElementById("via").value;
    var civico = document.getElementById("civico").value;
    var paese = document.getElementById("paese").value;
    var cap = document.getElementById("cap").value;
    var telefono = document.getElementById("telefono").value;

    // Creare un nuovo elemento div per il riepilogo dei dati (card)
    var riepilogoDiv = document.createElement("div");
    riepilogoDiv.classList.add("card");

    // Costruire il riepilogo dei dati
    riepilogoDiv.innerHTML = `
        <div class="card-body">
            <h5 class="card-title">Ristorante: ${nome}</h5>
            <p class="card-text"><strong>Nome:</strong> ${nome}</p>
            <p class="card-text"><strong>Posti:</strong> ${posti}</p>
            <p class="card-text"><strong>Via:</strong> ${via}</p>
            <p class="card-text"><strong>Civico:</strong> ${civico}</p>
            <p class="card-text"><strong>Paese:</strong> ${paese}</p>
            <p class="card-text"><strong>CAP:</strong> ${cap}</p>
            <p class="card-text"><strong>Numero di Telefono:</strong> ${telefono}</p>
        </div>
    `;

    // Aggiungere il riepilogo dei dati al contenitore
    document.getElementById("riepiloghi-container").appendChild(riepilogoDiv);

    // Nascondere la tabella per l'inserimento dei dati
    document.getElementById("tabella-dati").classList.add("hidden");

    // Svuotare i campi di input per il prossimo inserimento
    document.getElementById("nome").value = "";
    document.getElementById("posti").value = "";
    document.getElementById("via").value = "";
    document.getElementById("civico").value = "";
    document.getElementById("paese").value = "";
    document.getElementById("cap").value = "";
    document.getElementById("telefono").value = "";
}
   
