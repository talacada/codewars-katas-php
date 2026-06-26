<?php

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../../Kata/Y2026/Q2/BitCounting.php';
use function Kata\Y2026\Q2\countBits;

class BitCountingTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame(0, countBits(0));
        $this->assertSame(1, countBits(4));
        $this->assertSame(3, countBits(7));
        $this->assertSame(2, countBits(9));
        $this->assertSame(2, countBits(10));
        $this->assertSame(5, countBits(1234));
    }
}

