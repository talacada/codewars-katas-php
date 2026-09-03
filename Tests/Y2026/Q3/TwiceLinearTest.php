<?php

declare(strict_types=1);

namespace Y2026\Q3\TwiceLinear;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/TwiceLinear.php';
use function Kata\Y2026\Q3\TwiceLinear\dblLinear;

class TwiceLinearTest extends TestCase
{
    private function revTest(int $actual, int $expected): void
    {
        $this->assertSame($expected, $actual);
    }
    public function testBasics(): void
    {
        $this->revTest(dblLinear(10), 22);
        $this->revTest(dblLinear(20), 57);
        $this->revTest(dblLinear(30), 91);
        $this->revTest(dblLinear(50), 175);
        $this->revTest(dblLinear(100), 447);
    }
}
