<?php
$servername = "localhost:3306";
$db_username = "root";
$db_password = "root";
$dbname = "the_fork";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
