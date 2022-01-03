<style>
    .content {
        max-width: 500px;
        margin: auto;
    }
</style>
<body>

<div class="content">
    <html>
    <title>
        StorageLand
    </title>
    <body>
    <h1> Welcome to the StorageLand</h1>
    <p>
        This Web App provides the following free services
    </p>

    <ul>
        <li>you can store your files (up to 8mb per file)</li>
        <li>you can view a list of your stored files</li>
        <li>you can download, delete and rename your files</li>
    </ul>

    <p>
        To be able to use those services, you need to log in with your credentials.
    </p>
    <p>
        <?php
        $req_code =  http_response_code();
        if (isset($_GET["code"]) and $_GET["code"] == 1){
            echo '<b style="color:orangered">User not found, please try again with correct login</b>';
        }
        ?>
    </p>
    <form method="post" action="./controller/login_controller">
        <label> User name:<br>
            <input name="user_name" />
        </label>
        <br><br>
        <label>Password:<br>
            <input name="pass_word"/>
        </label>
        <br><br>
        <input type="submit" name="submit" value="login">
    </form>
    <p>
        <?php
        if(isset($_REQUEST["code"])){
            $code = $_REQUEST["code"];
            if ($code == "sign_up_success"){
                echo '<b style="color:limegreen">Your account is set up, you can login in now</b>';
            }
        }
        ?>
    </p>
    <br>
    <p>
        if you don't have an account click on sign up to create a free account
    </p>


    <form method="post" action="./view/sign_up.php">
        <input type="submit" name="submit" value="sign up">
    </form>

    </body>
    </html>
</div>

</body>
