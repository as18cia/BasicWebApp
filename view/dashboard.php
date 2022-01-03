<?php
if(!isset($_SESSION))
{
    session_start();
}
$user_name = $_SESSION["user"]
?>
<style>
    .content {
        max-width: 500px;
        margin: auto;
    }
</style>
<div class="content">
    <html>
    <title>
        User Dashboard
    </title>
    <body>
    <p>
        <?php
        echo "<b>Welcome to your Dashboard $user_name</b>";
        echo "<br><br>";
        if(isset($_GET["code"])) {
            if ($_GET["code"] == 'success') {
                echo '<p style="color:limegreen">file uploaded</p>';
            } elseif ($_GET["code"] == 'too_large') {
                echo '<p style="color:limegreen">file too large, should be less than 8mb</p>';
            } elseif ($_GET["code"] == 'already_exists') {
                echo '<p style="color:orangered">file already uploaded</p>';
            }
        }
        unset($_GET["code"]);
        ?>
    </p>

    <P>
        You can choose and upload a file (up to 8mb and only one file at a time)<br>
        All your uploaded files will be displayed below<br>
        You can download or delete them.
    </P>
    <form method="post" action="../controller/upload_controller.php" enctype="multipart/form-data">
        <label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </label>
        <br><br>
        <label>
            <input type="submit" value="Upload file" name="submit">
        </label>
        <br><br>
    </form >

    <form method="post" action="../controller/file_controller.php">
        <p>
            <?php
            foreach($_SESSION["user_files"] as $item) {
                $file_name = $item["file_name"];
                $file_type = $item["file_type"];
                $file_size = $item["file_size"]."B";
                echo "<b>filename</b>: $file_name  <b>file_type</b>: $file_type  <b>file_size</b>: $file_size";

                $download = "download".str_replace(".", "///", $file_name);
                $delete = "delete".str_replace(".", "///", $file_name);

                echo "<input type='submit' value='downlaod' name='$download'>";
                echo "<input type='submit' value='delete' name='$delete'>";
                echo "<br>";
            }
            ?>
        </p>
    </form>
    <form method="post" action="../controller/logout_controller.php">
        <label>
            <input type="submit" name="logout" value="logout">
        </label>
    </form>

    </body>
    </html>
</div>

