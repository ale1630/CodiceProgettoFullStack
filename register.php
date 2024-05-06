<?php
session_start();
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['reg_email'];
    $password = $_POST['reg_password'];
    $nome = $_POST['reg_name'];
    $cognome = $_POST['reg_cognome'];
    $telefono = $_POST['reg_telefono'];

    // Verifica se lo username esiste già nel database
    $check_stmt = $conn->prepare("SELECT * FROM cliente WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Username già in uso
        echo "Email giù in uso";
    } else {
        // Username disponibile, procedi con la registrazione

        // Preparazione della query SQL con la dichiarazione preparata
        $stmt = $conn->prepare("INSERT INTO cliente (email, nome, cognome, telefono, password) VALUES (?, ?, ?, ?, ?)");

        // Hashing della password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Bind dei parametri
        $stmt->bind_param("sssss", $email,$nome, $cognome, $telefono, $hashed_password);

        if ($stmt->execute()) {
            // Registrazione completata con successo, reindirizza alla pagina successiva
            header("Location: index.php");
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
