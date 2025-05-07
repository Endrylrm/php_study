<?php
require_once "Game.php";

class FizzBuzz extends Game
{
    protected function rules(mixed $args = 0)
    {
        if ($args % 15 == 0) {
            return "Fizz Buzz";
        } else if ($args % 5 == 0) {
            return "Buzz";
        } else if ($args % 3 == 0) {
            return "Fizz";
        } else {
            return $args;
        }
    }

    public function start(mixed $args = 100)
    {
        for ($i = 1; $i < $args; $i++) {
            echo $this->rules($i);
            echo "<br>";
        }
    }
}
