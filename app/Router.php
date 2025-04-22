<?php

class Router
{
    public static function get(string $path, callable $callback)
    {
        if ($_SERVER["REQUEST_URI"] == $path && $_SERVER["REQUEST_METHOD"] = "GET") {
            $callback();
        }
    }

    public static function post(string $path, callable $callback)
    {
        if ($_SERVER["REQUEST_URI"] == $path && $_SERVER["REQUEST_METHOD"] = "POST") {
            $callback();
        }
    }

    public static function put(string $path, callable $callback)
    {
        if ($_SERVER["REQUEST_URI"] == $path && $_SERVER["REQUEST_METHOD"] = "PUT") {
            $callback();
        }
    }

    public static function delete(string $path, callable $callback)
    {
        if ($_SERVER["REQUEST_URI"] == $path && $_SERVER["REQUEST_METHOD"] = "DELETE") {
            $callback();
        }
    }

    public static function patch(string $path, callable $callback)
    {
        if ($_SERVER["REQUEST_URI"] == $path && $_SERVER["REQUEST_METHOD"] = "PATCH") {
            $callback();
        }
    }
}
