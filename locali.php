<?php
session_start();
require_once "database.php";

$sql = "SELECT * FROM locale";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
