<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/CarParkEscape.php';
use function Kata\Y2026\Q2\escape;

class CarParkEscapeTest extends TestCase
{
    public function testSampleTests()
    {
        $carpark = [[1, 0, 0, 0, 2],
            [0, 0, 0, 0, 0]];
        $result = ["L4", "D1", "R4"];

        $this->assertSame($result, escape($carpark));

        $carpark = [[2, 0, 0, 1, 0],
            [0, 0, 0, 1, 0],
            [0, 0, 0, 0, 0]];
        $result = ["R3", "D2", "R1"];

        $this->assertSame($result, escape($carpark));

        $carpark = [[0, 2, 0, 0, 1],
            [0, 0, 0, 0, 1],
            [0, 0, 0, 0, 1],
            [0, 0, 0, 0, 0]];
        $result = ["R3", "D3"];

        $this->assertSame($result, escape($carpark));

        $carpark = [[1, 0, 0, 0, 2],
            [0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]];
        $result = ["L4", "D1", "R4", "D1", "L4", "D1", "R4"];

        $this->assertSame($result, escape($carpark));
    }
}
