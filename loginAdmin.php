<?php
session_start();
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codiceOperatore = $_POST['codiceOperatore'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT password FROM admin WHERE codiceOperatore = ?");
    $stmt->bind_param("s", $codiceOperatore);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['codiceOperatore'] = $codiceOperatore;
            header("Location: areaAdmin.php");
            exit();
        } else {
            header("Location: loginAdmin.php");
        }
    } else {
        header("Location: loginAdmin.php");

    }

    $stmt->close();
    $conn->close();
}
?>
