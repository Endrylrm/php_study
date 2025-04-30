<?php
require "UserDB.php";
require "Router.php";

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

Router::get("/", function () {
    echo json_encode(["result" => "Hello World!"]);
});

Router::get("/users", function () {
    $dbHandler = new UserDB();

    $users = $dbHandler->selectAllUsers();

    echo json_encode($users);

    $dbHandler = null;
});

Router::post("/users", function () {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];
    $response = [];

    if (!isset($data["name"])) {
        $response = ["error" => "Name not set to add a user!"];
        echo json_encode($response);
        return;
    }

    if (!isset($data["email"])) {
        $response = ["error" => "Email not set to add a user!"];
        echo json_encode($response);
        return;
    }

    if (!isset($data["age"])) {
        $response = ["error" => "Age not set to add a user!"];
        echo json_encode($response);
        return;
    }

    $dbHandler = new UserDB();

    $dbHandler->createUser(array_values($data));

    $dbHandler = null;

    $response = ["success" => "User Created successfully!"];
    echo json_encode($response);
});

Router::put("/users", function () {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];

    $dbHandler = new UserDB();

    if (isset($data["id"])) {
        $userUpdated = $dbHandler->updateUser($data);

        $dbHandler = null;

        $response = ["success" => "User Updated successfully!"];

        echo json_encode($response);
        return;
    }

    $dbHandler->createUser(array_values($data));

    $dbHandler = null;

    $response = ["success" => "User Created successfully!"];
    echo json_encode($response);
});

Router::delete("/users/{id}", function ($id) {
    $dbHandler = new UserDB();

    $dbHandler->deleteUser($id);

    $dbHandler = null;

    $response = ["success" => "User deleted successfully!"];
    echo json_encode($response);
});

Router::patch("/users/{id}", function ($id) {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];
    $data["id"] = $id;

    $dbHandler = new UserDB();

    $userUpdated = $dbHandler->updateUser($data);

    $dbHandler = null;

    $response = ["success" => "User Updated successfully!"];
    echo json_encode($response);
});

Router::dispatch($path);
