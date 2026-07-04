<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/NextBiggerNumber.php';
use function Kata\Y2026\Q2\nextBigger;

class NextBiggerNumberTest extends TestCase
{
    public function testBasicTests(): void
    {
        $this->assertSame(21, nextBigger(12));
        $this->assertSame(531, nextBigger(513));
        $this->assertSame(2071, nextBigger(2017));
        $this->assertSame(441, nextBigger(414));
        $this->assertSame(414, nextBigger(144));
        $this->assertSame(151, nextBigger(115));
        $this->assertSame(-1, nextBigger(550));
        $this->assertSame(1200, nextBigger(1020));
        $this->assertSame(12223233, nextBigger(12222333));
        $this->assertSame(-1, nextBigger(33322211));
        $this->assertSame(-1, nextBigger(100));
        $this->assertSame(123456798, nextBigger(123456789));
        $this->assertSame(1234567908, nextBigger(1234567890));
        $this->assertSame(-1, nextBigger(9876543210));
        $this->assertSame(-1, nextBigger(9999999999));
        $this->assertSame(59884848483559, nextBigger(59884848459853));
    }
}
