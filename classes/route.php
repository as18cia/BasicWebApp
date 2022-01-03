<?php

class Route{
     public static array $valid_routes = array();

     public static function set_route($route, $function){
         self::$valid_routes[$route] = $function;
     }
}
