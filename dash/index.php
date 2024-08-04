<?php
include_once "../templates/head.php";
include_once "../lib/require_signin.php";
?>

<style>
    form {
        width: max-content;
        margin: auto auto;
        text-align: center;
    }
</style>

<form action="/dash/upload.php" method="post" enctype="multipart/form-data">
    <h1>Welcome <?php echo $_SESSION["username"]; ?></h1>
    <p><a href="logout.php">Logout?</a></p>
    <h2>New Upload</h2>
    <br>
    <label>
        <input type="text" name="title" placeholder="Title" style="width:33vw;" aria-required="true" required>
    </label>
    <br>
    <label>
        <textarea type="text" maxlength="16777214" name="content" style="width:33vw;"
                  placeholder="Say whatever you want! Markdown supported."></textarea>
    </label>
    <br>
    <label>
        <input name="link_href" type="url" placeholder="https://url.com" style="width:33vw;">
    </label>
    <br>
    <label>
        <input type="file" name="upload" id="upload" accept="application/zip, image/png, image/jpeg" style="width:33vw;">
    </label>
    <br>
    <button type="submit">Upload</button>
</form>
<form></form>
<h2>Manage Uploads</h2>
<?php
    require_once "../db.php";
    global $conn;

    $sql = "SELECT * FROM uploads WHERE author = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["username"]);
    $stmt->execute();
    $results = $stmt->get_result();

    if ($results->num_rows > 0) {
        while ($data = $results->fetch_assoc()) {
            ?>

            <details>
                <summary><?php echo $data["title"]; ?></summary>
                <form action="/dash/upload.php" method="post">
                    <?php
                    if (str_contains($data["upload_name"], "webp")) {
                        echo "<a href='/uploads/" . $data["upload_name"] . "'><img loading='lazy' height='100%' width='100vw' src='/uploads/" . $data["upload_name"] . "'></a> <br>";
                    }
                    ?>
                    <label>
                        <input type="number" name="id" value="<?php echo $data["id"]; ?>" placeholder="ID" aria-required="true" required readonly aria-readonly="true" style="display:none;">
                    </label>
                    <br>
                    <label>
                        <input type="text" name="title" value="<?php echo $data["title"]; ?>" placeholder="Title" style="width:33vw;" aria-required="true" required>
                    </label>
                    <br>
                    <label>
                    <textarea type="text" maxlength="16777214" name="content" style="width:33vw;"
                              placeholder="Say whatever you want! Markdown supported."><?php echo $data["content"]; ?></textarea>
                    </label>
                    <br>
                    <label>
                        <input name="link_href" type="url" value="<?php echo $data["link_href"]; ?>" placeholder="https://url.com" style="width:33vw;">
                    </label>
                    <br>
                    <button type="submit">Edit</button>
                    <a href="delete.php?id=<?php echo $data["id"]; ?>">Delete</a>
                </form>
            </details>

            <?php
        }
    } else {
        echo "<p>No uploads</p>";
    }
?>

<?php
include_once "../templates/end.php";
?>
