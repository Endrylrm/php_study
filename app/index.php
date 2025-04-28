<?php
require "database.php";
require "Router.php";

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

Router::get("/", function () {
    echo json_encode(["result" => "Hello World!"]);
});

Router::get("/users", function () {
    $dbHandler = new DatabaseHandler();

    //$dbHandler->createUser(["Teste6", "teste6@hotmail.com", 30]);
    //$dbHandler->createMultipleUsers([["Teste4", "teste4@hotmail.com", 30], ["Teste5", "teste5@hotmail.com", 30], ["Teste6", "teste6@hotmail.com", 30]]);
    //$dbHandler->updateUser(["name" => "Teste6", "email" => "teste6@hotmail.com", "id" => 6]);

    $users = $dbHandler->selectAllUsers();

    echo json_encode($users);

    $dbHandler = null;
});

Router::post("/users", function () {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = [];

    if (!isset($data["name"])) {
        $result = ["error" => "Name not set to add a user!"];
        echo json_encode($result);
        return;
    }

    if (!isset($data["email"])) {
        $result = ["error" => "Email not set to add a user!"];
        echo json_encode($result);
        return;
    }

    if (!isset($data["age"])) {
        $result = ["error" => "Age not set to add a user!"];
        echo json_encode($result);
        return;
    }

    $dbHandler = new DatabaseHandler();

    $users = $dbHandler->createUser(array_values($data));

    $dbHandler = null;

    $result = ["success" => "User Created successfully!"];
    echo json_encode($result);
});

Router::put("/users", function () {
    echo json_encode(["result" => "Test"]);
});

Router::get("/test", function () {
    echo json_encode(["result" => "Test"]);
});

Router::get("/test/{id}", function ($id) {
    $data = ["test {$id}"];
    $json = json_encode($data);
    echo $json;
});

Router::dispatch($path);
