function aggiungi() {
    // Mostra la tabella per l'inserimento dei dati
    document.getElementById("tabella-dati").classList.remove("hidden");
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

    // Inserire i valori nel riepilogo
    document.getElementById("riepilogo-nome").textContent = nome;
    document.getElementById("riepilogo-posti").textContent = posti;
    document.getElementById("riepilogo-via").textContent = via;
    document.getElementById("riepilogo-civico").textContent = civico;
    document.getElementById("riepilogo-paese").textContent = paese;
    document.getElementById("riepilogo-cap").textContent = cap;
    document.getElementById("riepilogo-telefono").textContent = telefono;

    // Nascondere la tabella per l'inserimento dei dati e mostrare il riepilogo
    document.getElementById("tabella-dati").classList.add("hidden");
    document.getElementById("riepilogo").classList.remove("hidden");
}