<?php

class MysqlConnection
{

    public function create_connection(){
        $host = getenv("MYSQL_DBHOST");
        $port = getenv("MYSQL_DBPORT");
        $user_name = getenv("MYSQL_DBUSER");
        $password = getenv("MYSQL_DBPASS");

        $connection = new mysqli(hostname: $host, username:  $user_name, password: $password, port:  $port);
        $connection->query("CREATE DATABASE IF NOT EXISTS basicwebapp");
        $connection->query("CREATE TABLE IF NOT EXISTS basicwebapp.USERS(
                                  user_name varchar(25),
                                  PASSWORD varchar(25) NOT NULL,
                                  PRIMARY KEY  (USER_Name));");

        $connection->query("CREATE TABLE IF NOT EXISTS basicwebapp.files(
                                  user_name varchar(25),
                                  file_name varchar(50) NOT NULL,
                                  file_format varchar(25) NOT NULL,
                                  file_size INT NOT NULL,
                                  file_path varchar (10000) NOT NULL,
                                  PRIMARY KEY  (user_name, file_name));");

        return $connection;
    }

    public function user_exists($user_name): bool
    {
        $db = $this->create_connection();
        $query = "SELECT * FROM basicwebapp.USERS Where user_name = '$user_name';";
        $result = $db->query($query);

        $db->close();
        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    public function user_with_pass_exists($user_name, $password): bool
    {
        $db = $this->create_connection();

        $query = "SELECT * FROM basicwebapp.USERS Where user_name ='$user_name' and password= '$password';";
        $result = $db->query($query);
        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    public function add_new_user($user_name, $password){
        $db = $this->create_connection();
        $query = "INSERT INTO basicwebapp.USERS VALUES ('$user_name', '$password')";
        $db->query($query);
        $db->close();
    }

    public function upload_file($user_name, $file_name, $file_type, $file_size, $storage_path){
        $db = $this->create_connection();
        $query = "INSERT INTO basicwebapp.files VALUES ('$user_name', '$file_name', '$file_type', '$file_size', '$storage_path');";
        $db->query($query);
    }

    public function get_files_for_user($user_name){
        $db = $this->create_connection();
        $query = "SELECT file_name, file_format, file_size, file_path FROM basicwebapp.files WHERE user_name = '$user_name';";
        $result = $db->query($query);
        $rows = [];
        while($row = $result->fetch_row()) {
            $rows[] = array(
                "file_name"  => $row[0],
                "file_type" => $row[1],
                "file_size"   => $row[2],
                "storage_path" => $row[3],
            );
        }
        return $rows;
    }

    public function file_already_uploaded($user_name, $file_name){
        $db = $this->create_connection();
        $query = "SELECT * FROM basicwebapp.files WHERE user_name = '$user_name' and file_name = '$file_name';";
        $result = $db->query($query);
        if ($result->num_rows == 0) {
            return false;
        }

        return true;
    }

    public function delete_file($user_name, $file_name){
        $db = $this->create_connection();
        $query = "DELETE FROM basicwebapp.files WHERE user_name ='$user_name' and file_name ='$file_name';";
        $db->query($query);
    }
}