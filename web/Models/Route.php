<?php

class Route
{
    public static $getRoutes = [];
    public static $postRoutes = [];

    public static function get($route, $action)
    {
        self::$getRoutes[] = $route;
        if ($_SERVER['REQUEST_URI'] == $route) {
            $action->__invoke();
        }
    }

    public static function post($route, $action)
    {
        self::$postRoutes[] = $route;
        if ($_SERVER['REQUEST_URI'] == $route) {
            $action->__invoke();
        }
    }
}