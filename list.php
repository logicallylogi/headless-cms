<?php
require_once('./db.php');
global $conn;

$output = [];
if (array_key_exists("author", $_GET)) {
    $sql = "SELECT * FROM uploads WHERE author = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["username"]);
} else {
    $sql = "SELECT * FROM uploads";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$results = $stmt->get_result();
while ($data = $results->fetch_assoc()) {
    $output[] = $data;
}

header('Content-type: application/json');
echo json_encode($output);