<?php
session_start();
require_once "database.php";

// Verifica se l'ID della ricetta è stato passato come parametro nella URL
if (isset($_GET['id'])) {
    $ricetta_id = $_GET['id'];

    // Query per recuperare i dettagli della ricetta dal database
    $sql = "SELECT * FROM ricette WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ricetta_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>