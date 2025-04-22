<?php

class Router
{
    private static array $routes = [];

    public static function get(string $path, Closure $callback)
    {
        self::$routes[] = [
            'path'   => $path,
            'callback' => $callback,
            'method' => 'GET'
        ];
    }

    public static function post(string $path, Closure $callback)
    {
        self::$routes[] = [
            'path'   => $path,
            'callback' => $callback,
            'method' => 'POST'
        ];
    }

    public static function put(string $path, Closure $callback)
    {
        self::$routes[] = [
            'path'   => $path,
            'callback' => $callback,
            'method' => 'PUT'
        ];
    }

    public static function delete(string $path, Closure $callback)
    {
        self::$routes[] = [
            'path'   => $path,
            'callback' => $callback,
            'method' => 'DELETE'
        ];
    }

    public static function patch(string $path, Closure $callback)
    {
        self::$routes[] = [
            'path'   => $path,
            'callback' => $callback,
            'method' => 'PATCH'
        ];
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

        echo "404 - Page not found";
    }
}
