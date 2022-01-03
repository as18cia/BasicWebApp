<?php
if(!isset($_SESSION))
{
    session_start();
}



class HomeController{

    public static function create_view(){

        #checking if user already logged in
        #if Not user logged in -> redirect to main page
        #else redirect to dashboard
        if(isset($_SESSION["user"])){
//            include("./view/dashboard.php");
            header("Location: http://localhost:8080/BasicWebApp/view/dashboard");
        }else{
            include("./view/login.php");
        }

    }
}