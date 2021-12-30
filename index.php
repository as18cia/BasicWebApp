<!DOCTYPE html>
<html>
    <title>
        BasicWebApp
    </title>
    <body>
        <h1> Welcome to the BasicWebApp</h1>
        <p>
            This Web App provides the following free services
        </p>

        <ul>
            <li>you can store your files (up to 8mb per file)</li>
            <li>you can view a list of your stored files</li>
            <li>you can download, delete and rename your files</li>
        </ul>

        <p>
        To be able to use those services, you need to log in with your credential, if you don't have an account
        <br> you can create a free one by clicking on the "sign up" button bellow.
        </p>

        <form method="get" action="dashboard.php">
            <label>
                <input name="user_name"/>
            </label>
            <br><br>
            <label>
                <input name="pass_word"/>
            </label>
            <br><br>
            <input type="submit" name="submit">
        </form>

    </body>
</html>