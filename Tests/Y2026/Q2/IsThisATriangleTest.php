<?php

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../../Kata/Y2026/Q2/IsThisATriangle.php';
use function Kata\Y2026\Q2\isTriangle;

class IsThisATriangleTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertTrue(isTriangle(1, 2, 2));
        $this->assertFalse(isTriangle(1, 2, 3));
        $this->assertFalse(isTriangle(-5, 1, 3));
        $this->assertFalse(isTriangle(0, 2, 3));
        $this->assertFalse(isTriangle(1, 2, 9));
    }
}

