<?php

require_once "Shapes.php";

class Rectangle implements Shapes2D
{
    private float $base;
    private float $height;

    function __construct(float $base, float $height)
    {
        $this->base = $base;
        $this->height = $height;
    }

    public function area(): int|float
    {
        return $this->base * $this->height;
    }

    public function perimeter(): int|float
    {
        return 2 * ($this->base + $this->height);
    }
}
