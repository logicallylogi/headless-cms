<?php
include_once "../templates/head.php";
include_once "../lib/require_signin.php";

$_SESSION["username"] = null;
session_destroy();

echo "You are logged out.";

include_once "../templates/end.php";
