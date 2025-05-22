<?php

require_once "Shapes.php";

class Square implements Shapes2D
{
    private float $side;

    function __construct(float $side)
    {
        $this->side = $side;
    }

    public function area(): int|float
    {
        return $this->side ** 2;
    }

    public function perimeter(): int|float
    {
        return $this->side * 4;
    }
}
