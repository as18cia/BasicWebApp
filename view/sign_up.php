<style>
    .content {
        max-width: 500px;
        margin: auto;
    }
</style>
<div class="content">
    <html>

    <title>
        create a free account
    </title>

    <body>
    <p>
        <?php
        if(isset($_GET["message"]))
            echo '<p style="color:orangered">'.$_GET["message"].'</p>';
            echo "<br>";
        ?>
    </p>

    <p>
        To create an account choose a user name and a password<br>
        <b>After successfully creating an account, you will be redirected to the home page</b>
    </p>


    <form method="post" action="../controller/sign_up_controller.php">
        <label>User name: <br>
            <input name="user_name"/>
        </label>
        <br><br>
        <label>Password: <br>
            <input name="pass_word"/>
        </label>
        <br><br>
        <label>Confirm Password: <br>
            <input name="confirm_pass_word"/>
        </label>
        <br><br>
        <input type="submit" name="submit">
    </form>
    </body>

    </html>
</div>

