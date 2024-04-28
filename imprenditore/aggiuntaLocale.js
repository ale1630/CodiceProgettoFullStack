// Funzione per mostrare la tabella per l'inserimento dei dati
function aggiungi() {
    document.getElementById("tabella-dati").classList.remove("hidden");
}

// Funzione per registrare i dati e visualizzare il riepilogo
function registraDati() {
    // Ottenere i valori dai campi di input
    var nome = document.getElementById("nome").value;
    var posti = document.getElementById("posti").value;
    var via = document.getElementById("via").value;
    var civico = document.getElementById("civico").value;
    var paese = document.getElementById("paese").value;
    var cap = document.getElementById("cap").value;
    var telefono = document.getElementById("telefono").value;

    // Creare un nuovo elemento div per il riepilogo dei dati
    var riepilogoDiv = document.createElement("div");
    riepilogoDiv.classList.add("riepilogo");

    // Costruire il riepilogo dei dati
    riepilogoDiv.innerHTML = `
        <h2>${nome}</h2>
        <p><strong>Nome:</strong> ${nome}</p>
        <p><strong>Posti:</strong> ${posti}</p>
        <p><strong>Via:</strong> ${via}</p>
        <p><strong>Civico:</strong> ${civico}</p>
        <p><strong>Paese:</strong> ${paese}</p>
        <p><strong>CAP:</strong> ${cap}</p>
        <p><strong>Numero di Telefono:</strong> ${telefono}</p>
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
