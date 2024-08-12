<?php
include_once "../templates/head.php";
include_once "../lib/require_signin.php";
require_once "../db.php";
global $conn;

$allowedTypes = [
    'application/zip' => 'zip',
    'image/png' => 'png',
    'image/jpeg' => 'jpg'
];

$images = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg'
];


if (array_key_exists("id", $_POST)) {
    $sql = "UPDATE `uploads` SET `title` = ?, `content` = ?, `link_href` = ? WHERE `id` = ? AND `author` =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $_POST["title"], $_POST["content"], $_POST["link_href"], $_POST["id"], $_SESSION["username"]);
    echo "<p>Update request sent</p>";
} else {
    if ($_FILES["upload"]['tmp_name'] != "") {
        $filepath = $_FILES['upload']['tmp_name'];
        $fileSize = filesize($filepath);
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($fileinfo, $filepath);

        if ($fileSize === 0) {
            die("<p>File was detected, but contained no data. Data upload request rejected.</p>");
        }
        if ($fileSize > (1024 * 1024 * 100)) {
            die("<p>File was detected, but file was too large. Data upload request rejected.</p>");
        }
        if(!in_array($filetype, array_keys($allowedTypes))) {
            die("<p>File was detected, but file type is not allowed. Data upload request rejected.</p>");
        }

        if (in_array($filetype, array_keys($images))) {
            echo "Image file detected. Compressing image.";
            require_once "../lib/image.php";
            $newFilename = webpImage($filepath, 25, true);
        } else {
            $filename = sha1(microtime(true) . sha1_file($filepath));
            $extension = $allowedTypes[$filetype];

            $targetDirectory = __DIR__ . ".\\..\\uploads";
            $newFilepath = $targetDirectory . "\\" . $filename . "." . $extension;

            if (!copy($filepath, $newFilepath )) {
                die("<p>File was detected, but copy failed. Data upload request rejected.</p>");
            }
            unlink($filepath);
        }

        $sql = "INSERT INTO `uploads` (`title`, `content`, `link_href`, `author`, `upload_name`) VALUES(?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $_POST["title"], $_POST["content"], $_POST["link_href"], $_SESSION["username"], $newFilename);
        echo "<p>Upload request sent with an attached file.</p>";

    } else {
        $sql = "INSERT INTO `uploads` (`title`, `content`, `link_href`, `author`) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $_POST["title"], $_POST["content"], $_POST["link_href"], $_SESSION["username"]);
        echo "<p>Upload request sent without an attached file.</p>";
    }
}

$stmt->execute();

header("Location: index.php");
include_once "../templates/end.php";