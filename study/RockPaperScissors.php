<?php
require_once "Game.php";

class RockPaperScissors extends Game
{
    public const int ROCK = 0;
    public const int PAPER = 1;
    public const int SCISSORS = 2;

    protected function rules(mixed $hands)
    {
        $result = match (true) {
            $hands["Player"] == $hands["Enemy"] => "Draw!",
            $hands["Player"] == self::ROCK && $hands["Enemy"] == self::SCISSORS => "Player wins with Rock",
            $hands["Player"] == self::ROCK && $hands["Enemy"] == self::PAPER => "Enemy wins with Paper",
            $hands["Player"] == self::PAPER && $hands["Enemy"] == self::ROCK => "Player wins with Paper",
            $hands["Player"] == self::PAPER && $hands["Enemy"] == self::SCISSORS => "Enemy wins with Scissors",
            $hands["Player"] == self::SCISSORS && $hands["Enemy"] == self::PAPER => "Player wins with Scissors",
            $hands["Player"] == self::SCISSORS && $hands["Enemy"] == self::ROCK => "Enemy wins with Rock",
            default => "Unable to decide!"
        };

        return $result;
    }

    public function start(mixed $playerHand = self::PAPER)
    {
        echo $this->rules(["Player" => $playerHand, "Enemy" => rand(0, 2)]);
    }
}
