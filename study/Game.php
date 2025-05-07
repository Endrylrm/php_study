<?php

abstract class Game
{
    abstract protected function rules(mixed $args);
    abstract public function start(mixed $args);
}
