<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/SmallestPossibleSum.php';
use function Kata\Y2026\Q2\solutionSmallestSum;

class SmallestPossibleSumTest extends TestCase
{
    public function testExample(): void
    {
        $this->assertSame(3, solutionSmallestSum([10, 15, 21]));
        $this->assertSame(6, solutionSmallestSum([18, 12, 8]));
        $this->assertSame(9, solutionSmallestSum([6, 9, 21]));
        $this->assertSame(18, solutionSmallestSum([18, 3, 3, 3, 3, 3]));
        $this->assertSame(2, solutionSmallestSum([10000000000, 1]));
        $this->assertSame(3, solutionSmallestSum([1, 21, 55]));
        $this->assertSame(5, solutionSmallestSum([3, 13, 23, 7, 83]));
        $this->assertSame(12, solutionSmallestSum([4, 16, 24]));
        $this->assertSame(12, solutionSmallestSum([30, 12]));
    }
}
