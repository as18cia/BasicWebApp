<?php


class FileController{

    public static function download_file(){

        $key = array_keys($_POST)[0];
        $key = str_replace("///", ".", $key);

        if(str_starts_with($key, 'download')) {
            $file_name = str_replace("download", "", $key);
            $user_name = $_SESSION["user"];
            $file_path =$_SERVER["DOCUMENT_ROOT"].'/BasicWebApp/files/'.$user_name.$file_name;
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file_path");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            // read the file from disk
            readfile($file_path);
        }elseif(str_starts_with($key, 'delete')){
            $file_name = str_replace("delete", "", $key);
            $user_name = $_SESSION["user"];
            $file_path =$_SERVER["DOCUMENT_ROOT"].'/BasicWebApp/files/'.$user_name.$file_name;
            #we delete the table entry
            $db_connection = new MysqlConnection();
            $db_connection->delete_file($user_name, $file_name);

            if (file_exists($file_path)) {
                unlink($file_path);
            }else{
                echo "wow";
            }

            #refresh the page
            $_SESSION["user_files"] = $db_connection->get_files_for_user($user_name);
            header("Location: http://localhost:8080/BasicWebApp/view/dashboard");
        }



    }
}
