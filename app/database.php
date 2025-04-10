<?php
include("User.php");

class DatabaseHandler
{
    private PDO $pdo;

    function createDBConnection()
    {
        $this->pdo = new PDO(
            "{$_ENV["APP_DB_CONNECTION"]}:host={$_ENV["APP_DB_HOST"]};dbname={$_ENV["APP_DB_NAME"]}",
            $_ENV["APP_DB_USER"],
            $_ENV["APP_DB_PASSWORD"]
        );

        return $this->pdo;
    }

    function selectUser(array $request)
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $query = $this->pdo->prepare($sql);
        $query->execute($request);
        $user = User::fromRequest($query->fetch());
        return $user;
    }

    function selectAllUsers()
    {
        $sql = 'SELECT * FROM users';
        $query = $this->pdo->query($sql);
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
        $query = $this->pdo->prepare($sql);
        $query->execute($request);
        echo "Usuário criado com sucesso!";
    }

    function createMultipleUsers(array $request)
    {
        $sql = 'INSERT INTO users(name, email, age) VALUES (?, ?, ?)';
        $query = $this->pdo->prepare($sql);
        foreach ($request as $user) {
            $query->execute($user);
        }
        echo "Usuários criados com sucesso!";
    }

    function updateUser(array $request)
    {
        if (!isset($request["id"])) {
            echo "ID está vazio, não é possível atualizar usuário!!!!";
            return;
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

        $query = $this->pdo->prepare($sql);
        $query->execute($params);

        if ($query->rowCount() > 0) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Nenhuma mudanças foram feitas.";
        }
    }

    function deleteUser(array $request)
    {
        $sql = 'DELETE FROM users WHERE id = ?';
        $query = $this->pdo->prepare($sql);
        $query->execute($request);
        echo "Usuário deletado com sucesso!";
    }
}
