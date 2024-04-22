<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CF = $_POST['CF'];
    $password = $_POST['password'];

    $servername = "localhost:3306";
    $db_username = "root";
    $db_password = "root";
    $dbname = "the_fork";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM imprenditore WHERE CF = ?");
    $stmt->bind_param("s", $CF);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['CF'] = $CF;
            header("Location: locali.php");
            exit();
        } else {
            header("Location: index.html");
        }
    } else {
        header("Location: index.html");

    }

    $stmt->close();
    $conn->close();
}
?>
