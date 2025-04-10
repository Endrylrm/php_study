<?php
include("database.php");

echo '<h1>Hello World!</h1>';

$dbHandler = new DatabaseHandler();

$db = $dbHandler->createDBConnection();

//$dbHandler->createUser(["Teste6", "teste6@hotmail.com", 30]);
//$dbHandler->createMultipleUsers([["Teste4", "teste4@hotmail.com", 30], ["Teste5", "teste5@hotmail.com", 30], ["Teste6", "teste6@hotmail.com", 30]]);
//$dbHandler->updateUser(["name" => "Teste6", "email" => "teste6@hotmail.com", "id" => 6]);

$users = $dbHandler->selectAllUsers();

foreach ($users as $user) {
    echo $user->name . " " . $user->email . " " . $user->age . "<br>";
}

$dbHandler = null;
$db = null;
