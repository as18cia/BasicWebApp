<?php

class LogoutController{
    public static function create_view(){
        #resetting the session and redirecting to the home page
        session_unset();
        header("Location: http://localhost:8080/BasicWebApp");
    }
}

