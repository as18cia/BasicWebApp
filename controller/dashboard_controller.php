<?php
if(!isset($_SESSION))
{
    session_start();
}


class DashboardController{
    public static function create_view(){
        if(isset($_SESSION["user"])){
            include("./view/dashboard.php");
        }else{
            header("Location: http://localhost:8080/BasicWebApp");
        }

    }
}