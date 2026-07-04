<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once "Kata/Y2026/Q2/RectangleRotation.php";
use function Kata\Y2026\Q2\rectangle_rotation;

class RectangleRotationTest extends TestCase
{
    public function testBasic(): void
    {
        $this->assertSame(13, rectangle_rotation(3, 3));
        $this->assertSame(23, rectangle_rotation(6, 4));
        $this->assertSame(65, rectangle_rotation(30, 2));
        $this->assertSame(49, rectangle_rotation(8, 6));
        $this->assertSame(333, rectangle_rotation(16, 20));
    }
}
