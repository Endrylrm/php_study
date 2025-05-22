<?php

require_once "Shapes.php";

class Triangle implements Shapes2D
{
    private float $height;
    private float $base;
    private float $left;
    private float $right;

    function __construct(int $base, int $left, int $right)
    {
        $this->base = $base;
        $this->left = $left;
        $this->right = $right;

        $this->height = 2 * $this->area() / $this->base;
    }

    public function area(): int|float
    {
        // heron formula
        $sub = $this->perimeter() / 2;
        $heron = $sub * ($sub - $this->base) * ($sub - $this->left) * ($sub - $this->right);
        return sqrt($heron);
    }

    public function perimeter(): int|float
    {
        return $this->base + $this->left + $this->right;
    }
}
