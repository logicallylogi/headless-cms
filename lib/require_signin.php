<?php
if (!array_key_exists("username", $_SESSION) || !isset($_SESSION["username"])) {
    header("Location: /index.php");
    die();
}
