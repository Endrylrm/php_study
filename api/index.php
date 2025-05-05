<?php
require "UserDB.php";
require "Router.php";

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$dbHandler = new UserDB();

Router::get("/", function () {
    echo json_encode(["result" => "Hello World!"]);
});

Router::get("/users", function () {
    global $dbHandler;

    $users = $dbHandler->selectAllUsers();

    echo json_encode($users);
});

Router::get("/users/{id}", function ($id) {
    global $dbHandler;

    $user = $dbHandler->selectUser($id);

    echo json_encode($user);
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

    global $dbHandler;

    $dbHandler->createUser(array_values($data));

    $response = ["success" => "User Created successfully!"];
    echo json_encode($response);
});

Router::put("/users", function () {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];

    global $dbHandler;

    if (isset($data["id"])) {
        $userUpdated = $dbHandler->updateUser($data);

        $response = ["success" => "User Updated successfully!"];

        echo json_encode($response);
        return;
    }

    $dbHandler->createUser(array_values($data));

    $response = ["success" => "User Created successfully!"];
    echo json_encode($response);
});

Router::delete("/users/{id}", function ($id) {
    global $dbHandler;

    $dbHandler->deleteUser($id);

    $response = ["success" => "User deleted successfully!"];
    echo json_encode($response);
});

Router::patch("/users/{id}", function ($id) {
    $data = json_decode(file_get_contents('php://input'), true) ?? [];
    $data["id"] = $id;

    global $dbHandler;

    $userUpdated = $dbHandler->updateUser($data);

    $response = ["success" => "User Updated successfully!"];
    echo json_encode($response);
});

Router::dispatch($path);

// not necessary anymore
$dbHandler = null;
