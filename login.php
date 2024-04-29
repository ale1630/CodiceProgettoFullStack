<?php
session_start();
require_once "database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
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
