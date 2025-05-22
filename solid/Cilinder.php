<?php

require_once "Shapes.php";

class Triangle implements Shapes2D, Shapes3D
{
    private float $height;
    private float $radius;

    function __construct(int $radius, int $height)
    {
        $this->radius = $radius;
        $this->height = $height;
    }

    public function area(): int|float
    {
        return 3.14 * $this->radius ** 2;
    }

    public function perimeter(): int|float
    {
        return 2 * 3.14 * $this->radius;
    }

    public function volume(): int|float
    {
        return 3.14 * ($this->radius ** 2) * $this->height;
    }
}
