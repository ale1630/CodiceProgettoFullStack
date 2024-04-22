<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_CF = $_POST['reg_CF'];
    $nome = $_POST['reg_name'];
    $cognome = $_POST['reg_cognome'];
    $reg_telefono = $_POST['reg_telefono'];
    $password = $_POST['reg_password'];


    // Connessione al database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";
    $dbname = "the_fork";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Controllo della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Verifica se lo username esiste già nel database
    $check_stmt = $conn->prepare("SELECT * FROM imprenditore WHERE CF = ?");
    $check_stmt->bind_param("s", $reg_CF);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Username già in uso
        echo "Email giù in uso";
    } else {
        // Username disponibile, procedi con la registrazione

        // Preparazione della query SQL con la dichiarazione preparata
        $stmt = $conn->prepare("INSERT INTO imprenditore (CF,nome, cognome, telefono, password) VALUES (?, ?, ?, ?, ?)");

        // Hashing della password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Bind dei parametri
        $stmt->bind_param("sssss", $reg_CF, $nome, $cognome, $reg_telefono,$hashed_password );

        if ($stmt->execute()) {
            // Registrazione completata con successo, reindirizza alla pagina successiva
            header("Location: locali.php");
            exit();
        } else {
            echo "Errore durante la registrazione: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
