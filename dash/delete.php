<?php
include_once "../templates/head.php";
include_once "../lib/require_signin.php";
require_once "../db.php";
global $conn;
$sql = "SELECT upload_name FROM `uploads` WHERE id = ? AND author = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $_GET["id"], $_SESSION["username"]);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

unlink("../uploads/" . $data["upload_name"]);

$sql = "DELETE FROM `uploads` WHERE id = ? AND author = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $_GET["id"], $_SESSION["username"]);
$stmt->execute();
?>

<p>Deletion request sent to server.</p>

<?php
header("Location: index.php");

include_once "../templates/end.php";
?>