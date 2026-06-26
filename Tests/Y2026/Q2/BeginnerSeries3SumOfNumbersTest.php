<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/BeginnerSeries3SumOfNumbers.php';
use function Kata\Y2026\Q2\getSum;

class BeginnerSeries3SumOfNumbersTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame(1, getSum(1, 0));
        $this->assertSame(3, getSum(1, 2));
        $this->assertSame(1, getSum(0, 1));
        $this->assertSame(1, getSum(1, 1));
        $this->assertSame(-1, getSum(-1, 0));
        $this->assertSame(2, getSum(-1, 2));
    }
}
