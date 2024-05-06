<?php
require_once "../database.php";

if (isset($_GET['q'])) {
    $input = $_GET['q'];
    $suggerimenti = array();

    $sql = "SELECT id, nome FROM paese WHERE nome LIKE ?";
    $stmt = $conn->prepare($sql);
    $input_param = "%{$input}%";
    $stmt->bind_param("s", $input_param);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        // Aggiungi sia l'ID che il nome del paese ai suggerimenti
        $suggerimenti[] = array(
            "id" => $row["id"],
            "nome" => $row["nome"]
        );
    }

    // Restituisci i suggerimenti come JSON
    echo json_encode($suggerimenti);
}
?>
