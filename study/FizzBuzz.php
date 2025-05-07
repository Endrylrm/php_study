<?php
require_once "Game.php";

class FizzBuzz extends Game
{
    protected function rules(mixed $num = 0)
    {
        if ($num % 15 == 0) {
            return "Fizz Buzz";
        } else if ($num % 5 == 0) {
            return "Buzz";
        } else if ($num % 3 == 0) {
            return "Fizz";
        } else {
            return $num;
        }
    }

    public function start(mixed $num = 100)
    {
        for ($i = 1; $i < $num; $i++) {
            echo $this->rules($i);
            echo "<br>";
        }
    }
}
