<?php

declare(strict_types=1);

namespace Y2026\Q2;

use Kata\Y2026\Q2\ScreenLockingPatterns;
use PHPUnit\Framework\TestCase;

function countPatternsFrom(string $f, int $l): int
{
    $lock = new ScreenLockingPatterns($f, $l);
    return $lock->calculateFinalLength();
}
class ScreenLockingPatternsTest extends TestCase
{
    public function testBasicTests()
    {
        $this->assertSame(0, countPatternsFrom('A', 0));
        $this->assertSame(0, countPatternsFrom('A', 10));
        $this->assertSame(1, countPatternsFrom('B', 1));
        $this->assertSame(5, countPatternsFrom('C', 2));
        $this->assertSame(37, countPatternsFrom('D', 3));
        $this->assertSame(256, countPatternsFrom('E', 4));
        $this->assertSame(23280, countPatternsFrom('E', 8));
    }
}
