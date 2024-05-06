// Funzione per il logout
document.getElementById("logoutButton").addEventListener("click", function() {
    // Invia una richiesta AJAX per terminare la sessione
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Dopo aver terminato la sessione, reindirizza l'utente alla pagina di login
            window.location.href = "index.php";
        }
    };
    xhr.send();
});