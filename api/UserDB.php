<?php
require "DatabaseHandler.php";
require "User.php";

//$user = $dbHandler->selectUser(5);
//$users = $dbHandler->selectAllUsers();
//$dbHandler->createUser(["Teste6", "teste6@hotmail.com", 30]);
//$dbHandler->createMultipleUsers([["Teste4", "teste4@hotmail.com", 30], ["Teste5", "teste5@hotmail.com", 30], ["Teste6", "teste6@hotmail.com", 30]]);
//$dbHandler->updateUser(["name" => "Teste6", "email" => "teste6@hotmail.com", "id" => 6]);
//$dbHandler->deleteUser(10);

class UserDB extends DatabaseHandler
{
    function selectUser(int $id): User
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $query = $this->getDBConnection()->prepare($sql);
        $query->execute([$id]);
        $user = User::fromRequest($query->fetch());
        return $user;
    }

    function selectAllUsers(): array
    {
        $sql = 'SELECT * FROM users';
        $query = $this->getDBConnection()->query($sql);
        $rows = $query->fetchAll();
        $users = array();
        foreach ($rows as $row) {
            $user = User::fromRequest($row);
            array_push($users, $user);
        }
        return $users;
    }

    function createUser(array $request)
    {
        $sql = 'INSERT INTO users(name, email, age) VALUES (?, ?, ?)';
        $query = $this->getDBConnection()->prepare($sql);
        $query->execute($request);
    }

    function createMultipleUsers(array $request)
    {
        $sql = 'INSERT INTO users(name, email, age) VALUES (?, ?, ?)';
        $query = $this->getDBConnection()->prepare($sql);
        foreach ($request as $user) {
            $query->execute($user);
        }
    }

    function updateUser(array $request): bool
    {
        if (!isset($request["id"])) {
            echo "ID está vazio, não é possível atualizar usuário!!!!";
            return false;
        }

        $sql = 'UPDATE users SET ';
        $params = array();

        if (isset($request["name"])) {
            $sql .= "name = :name, ";
            $params[":name"] = $request["name"];
        }
        if (isset($request["email"])) {
            $sql .= "email = :email, ";
            $params[":email"] = $request["email"];
        }
        if (isset($request["age"])) {
            $sql .= "age = :age, ";
            $params[":age"] = $request["age"];
        }

        $sql = rtrim($sql, ", ");
        $sql .= ' WHERE id = :id';
        $params[":id"] = $request["id"];

        $query = $this->getDBConnection()->prepare($sql);
        $query->execute($params);

        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function deleteUser(int $id)
    {
        $sql = 'DELETE FROM users WHERE id = ?';
        $query = $this->getDBConnection()->prepare($sql);
        $query->execute([$id]);
    }
}
