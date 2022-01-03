<?php

include_once ($_SERVER["DOCUMENT_ROOT"].'/BasicWebApp/model/mysql_connection.php');


if(!isset($_SESSION))
{
    session_start();
}

class LoginController{

    public static function create_view(){
        $user_name = $_POST["user_name"];
        $pass_word = $_POST["pass_word"];

        # if user exists we redirect to the dashboard
        if (self::process_login_info($user_name, $pass_word)){
            $_SESSION['user'] = $user_name;
            $db_connection = new MysqlConnection();
            $_SESSION["user_files"] = $db_connection->get_files_for_user($user_name);
            header("Location: http://localhost:8080/BasicWebApp/view/dashboard");
        }else{
            # if user doesn't exist we display error message
            header("Location: http://localhost:8080/BasicWebApp?code=1");
        }
    }

    private static function process_login_info($user_name, $pass_word){
        $db_connection = new MysqlConnection();
        if ($db_connection->user_with_pass_exists($user_name, $pass_word)) {
            return true;
        }
        return false;
    }
}



