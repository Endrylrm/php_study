<?php
require_once "Game.php";

enum HandsRPC
{
    case ROCK;
    case PAPER;
    case SCISSORS;

    public static function random(): self
    {
        $length = count(self::cases()) - 1;

        return self::cases()[rand(0, $length)];
    }
}

class RockPaperScissors extends Game
{
    protected function rules(mixed $hands)
    {
        $result = match (true) {
            $hands["Player"] == $hands["Enemy"] => "Draw!",
            $hands["Player"] === HandsRPC::ROCK && $hands["Enemy"] === HandsRPC::SCISSORS => "Player wins with Rock",
            $hands["Player"] === HandsRPC::ROCK && $hands["Enemy"] === HandsRPC::PAPER => "Enemy wins with Paper",
            $hands["Player"] === HandsRPC::PAPER && $hands["Enemy"] === HandsRPC::ROCK => "Player wins with Paper",
            $hands["Player"] === HandsRPC::PAPER && $hands["Enemy"] === HandsRPC::SCISSORS => "Enemy wins with Scissors",
            $hands["Player"] === HandsRPC::SCISSORS && $hands["Enemy"] === HandsRPC::PAPER => "Player wins with Scissors",
            $hands["Player"] === HandsRPC::SCISSORS && $hands["Enemy"] === HandsRPC::ROCK => "Enemy wins with Rock",
            default => "Unable to decide!"
        };

        return $result;
    }

    public function start(mixed $playerHand = HandsRPC::PAPER)
    {
        echo $this->rules(["Player" => $playerHand, "Enemy" => HandsRPC::random()]);
    }
}
