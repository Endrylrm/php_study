<?php

abstract class Game
{
    abstract protected function rules(mixed $args);
    abstract public function start(mixed $args);
}

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

class RockPaperScissors extends Game
{
    public const int ROCK = 0;
    public const int PAPER = 1;
    public const int SCISSORS = 2;

    protected function rules(mixed $player = self::ROCK, mixed $enemy = self::ROCK)
    {
        $result = match (true) {
            $player == $enemy => "Draw!",
            $player == self::ROCK && $enemy == self::SCISSORS => "Player wins with Rock",
            $player == self::ROCK && $enemy == self::PAPER => "Enemy wins with Paper",
            $player == self::PAPER && $enemy == self::ROCK => "Player wins with Paper",
            $player == self::PAPER && $enemy == self::SCISSORS => "Enemy wins with Scissors",
            $player == self::SCISSORS && $enemy == self::PAPER => "Player wins with Scissors",
            $player == self::SCISSORS && $enemy == self::ROCK => "Enemy wins with Rock",
            default => "Unable to decide!"
        };

        return $result;
    }

    public function start(mixed $args = self::PAPER)
    {
        echo $this->rules($args, rand(0, 2));
    }
}


$fizzBuzz = new FizzBuzz();
$fizzBuzz->start();

$rockPaperScissors = new RockPaperScissors();
$rockPaperScissors->start($rockPaperScissors::ROCK);
