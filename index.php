<?php
include_once "./templates/head.php";

if (array_key_exists("username", $_SESSION) && isset($_SESSION["username"])) {
    header("Location: dash/index.php");
}
?>
<style>
    #signin-form {
        max-width: max-content;
        margin: auto auto;
    }
</style>
<form id="signin-form" action="/dash/signin.php" method="post">
    <h1>Welcome to Eridian</h1>
    <label>Username <input id="username" name="username" type="text" maxlength="16" required aria-required="true"></label>
    <label>Password <input id="password" name="password" type="password" maxlength="99" required aria-required="true"></label>
    <br>
    <input type="submit">
</form>
<?php
include_once "./templates/end.php";
?>
