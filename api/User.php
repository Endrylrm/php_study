<?php

class User
{
    public int $id;
    public string $name;
    public string $email;
    public int $age;

    function __construct($id, $name, $email, $age)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }

    public static function fromRequest(array $request)
    {
        $user = new User(
            $request["id"],
            $request["name"],
            $request["email"],
            $request["age"]
        );

        return $user;
    }
}
