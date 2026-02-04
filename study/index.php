<?php

require "FizzBuzz.php";
require "RockPaperScissors.php";

$fizzBuzz = new FizzBuzz();
$fizzBuzz->start();

$rockPaperScissors = new RockPaperScissors();
$rockPaperScissors->start(HandsRPC::PAPER);
