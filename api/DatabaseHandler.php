<?php

class DatabaseHandler
{
    protected PDO $pdo;
    protected array $env;

    function __construct()
    {
        $this->env = parse_ini_file(".env");
        $this->pdo = new PDO(
            "{$this->env["APP_DB_CONNECTION"]}:host={$this->env["APP_DB_HOST"]};dbname={$this->env["APP_DB_NAME"]}",
            $this->env["APP_DB_USER"],
            $this->env["APP_DB_PASSWORD"]
        );
    }

    function getDBConnection()
    {
        return $this->pdo;
    }
}
