<?php

require_once "Shapes.php";

class Circle implements Shapes2D
{
    private float $radius;

    function __construct(float $radius)
    {
        $this->radius = $radius;
    }

    public function area(): int|float
    {
        return 3.14 * $this->radius ** 2;
    }

    public function perimeter(): int|float
    {
        return 2 * 3.14 * $this->radius;
    }
}
