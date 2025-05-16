<?php
require_once "Game.php";

class FizzBuzz extends Game
{
    protected function rules(mixed $num = 0)
    {
        return match (true) {
            $num % 15 == 0 => "Fizz Buzz",
            $num % 5 == 0 => "Buzz",
            $num % 3 == 0 => "Fizz",
            default => $num,
        };
    }

    public function start(mixed $num = 100)
    {
        for ($i = 1; $i < $num; $i++) {
            echo $this->rules($i);
            echo "<br>";
        }
    }
}
