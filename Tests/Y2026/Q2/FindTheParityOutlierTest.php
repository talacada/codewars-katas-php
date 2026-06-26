<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/FindTheParityOutlier.php';
use function Kata\Y2026\Q2\find;

class FindTheParityOutlierTest extends TestCase
{
    public function testBasics(): void
    {
        $this->assertSame(11, find([2, 4, 0, 100, 4, 11, 2602, 36]));
        $this->assertSame(160, find([160, 3, 1719, 19, 11, 13, -21]));
    }
}
