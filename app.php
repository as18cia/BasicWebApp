<?php
include_once("./classes/route.php");

class App{

    private function process_route() {

        $uri = $_SERVER['REQUEST_URI'];

        // Check if the route is in $Routes
        #todo: parameter processing
        #todo: remove trailing slash
        $route = explode('?',$uri)[0];
        if (!array_key_exists($route, Route::$valid_routes)) {
            header("Location: http://localhost:8088/BasicWebApp");
        }else{
            Route::$valid_routes[$route]();
        }


    }

    public function run(){
        $this->process_route();
    }
}