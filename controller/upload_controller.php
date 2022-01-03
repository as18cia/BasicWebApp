<?php

include_once ($_SERVER["DOCUMENT_ROOT"].'/BasicWebApp/model/mysql_connection.php');

class UploadController{

    public static function process_upload(){

        if(file_exists($_FILES['fileToUpload']['tmp_name'])){

            $user_name = $_SESSION["user"];
            $file_name = $_FILES["fileToUpload"]["name"];
            $file_type = $_FILES["fileToUpload"]["type"];
            $file_size = $_FILES["fileToUpload"]["size"];


            # checking if the file is less than 8 mb
            if($file_size>8*1000 * 1000){
                header("Location: http://localhost:8080/BasicWebApp/view/dashboard?code=too_large");
                die;
            }

            $db_connection = new MysqlConnection();
            #checking if the file is already uploaded
            if($db_connection->file_already_uploaded($user_name, $file_name)){
                header("Location: http://localhost:8080/BasicWebApp/view/dashboard?code=already_exists");
                die;
            }

            $file_path = $_SERVER["DOCUMENT_ROOT"].'/BasicWebApp/files/'.$user_name."/".$file_name;
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file_path)) {

                $db_connection->upload_file($user_name, $file_name, $file_type, $file_size, $file_path);
                $_SESSION["user_files"] = $db_connection->get_files_for_user($user_name);
                header("Location: http://localhost:8080/BasicWebApp/view/dashboard?code=success");
            } else {
                header("Location: http://localhost:8080/BasicWebApp/view/dashboard?code=failure");
            }

            unset($_FILES);
            header("Location: http://localhost:8080/BasicWebApp/view/dashboard?code=success");
        }else{
            header("Location: http://localhost:8080/BasicWebApp/view/dashboard");
        }
    }

}