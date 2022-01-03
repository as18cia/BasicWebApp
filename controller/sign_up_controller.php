<?php

include_once ($_SERVER["DOCUMENT_ROOT"].'/BasicWebApp/model/mysql_connection.php');



class SignUpController{

    public static function create_view(){
        # if user already signed up, send to dashboard
        if(isset($_SESSION["user"])){
            header("Location: http://localhost:8088/BasicWebApp/view/dashboard");
        }else{
            # else send to sign up form
            include("./view/sign_up.php");
        }
    }

    public static function process_info_and_create_view(){
        $user_name = $_POST["user_name"];
        $pass_word = $_POST["pass_word"];
        $confirm_password = $_POST["confirm_pass_word"];

        $is_info_valid = self::is_info_valid($pass_word, $confirm_password);

        if($is_info_valid["result"] == false){
            header("Location: http://localhost:8080/BasicWebApp/view/sign_up.php?message=".$is_info_valid["message"]);
            die;
        }
        # checking if the user exists already
        $db_connection = new MysqlConnection();
        if($db_connection->user_exists($user_name)){
            $message = "A user with that name already exists";
            header("Location: http://localhost:8080/BasicWebApp/view/sign_up.php?message=".$message);
        }else{
            # adding the new user
            $db_connection->add_new_user($user_name, $pass_word);
            #adding storage file for the user
            $folder = $_SERVER["DOCUMENT_ROOT"].'/BasicWebApp/files/'.$user_name;
            if (!file_exists($folder)) {
                mkdir($folder);
            }
            header("Location: http://localhost:8080/BasicWebApp?code=sign_up_success");
        }
    }

    private static function is_info_valid($pass_word, $confirm_pass_word): array{
        # checking the user password confirmation
        if ($pass_word != $confirm_pass_word) {
            return array('result' => false, 'message' => 'passwords don\'t match');
        }elseif (empty($pass_word)){
            return array('result' => false, 'message' => 'empty password');
        }
        return array('result' => true, 'message' => '');
    }
}




