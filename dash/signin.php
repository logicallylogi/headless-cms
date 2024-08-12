<?php
include_once "../templates/head.php";
require_once "../db.php";
global $conn;

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_POST["username"]);
$stmt->execute();
$results = $stmt->get_result();

if ($results->num_rows > 0) {
    $data = $results->fetch_assoc();
    if (password_verify($_POST["password"], $data["password"])) {
        $_SESSION["username"] = $data["username"];
        header("location: index.php");
    } else {
        echo "<p>Incorrect Password. Error: PASS_INVALID</p>";
        die();
    }
} else {
    echo "<p>Cannot verify identity. Error: USER-404</p>";
    die();
}

include_once "../templates/end.php";
