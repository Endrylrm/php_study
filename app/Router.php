<?php

class Router
{
    private static array $routes = [];

    private static function register(string $path, Closure $callback, string $method)
    {
        self::$routes[] = [
            'path'   => $path,
            'callback' => $callback,
            'method' => $method
        ];
    }

    public static function get(string $path, Closure $callback)
    {
        self::register($path, $callback, "GET");
    }

    public static function post(string $path, Closure $callback)
    {
        self::register($path, $callback, "POST");
    }

    public static function put(string $path, Closure $callback)
    {
        self::register($path, $callback, "PUT");
    }

    public static function delete(string $path, Closure $callback)
    {
        self::register($path, $callback, "DELETE");
    }

    public static function patch(string $path, Closure $callback)
    {
        self::register($path, $callback, "PATCH");
    }

    public static function dispatch(string $path): void
    {
        foreach (self::$routes as $route) {
            $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route["path"]);

            if (preg_match("#^$pattern$#", $path, $matches)) {
                array_shift($matches);

                if ($_SERVER["REQUEST_METHOD"] == $route["method"]) {
                    call_user_func_array($route["callback"], $matches);
                    return;
                }
            }
        }

        require "404.php";
    }
}
