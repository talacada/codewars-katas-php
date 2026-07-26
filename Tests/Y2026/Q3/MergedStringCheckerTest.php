<?php

declare(strict_types=1);

namespace Y2026\Q3;

use Kata\Y2026\Q3\MergedStringChecker;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q3/MergedStringChecker.php';

function isMerge(string $s, string $part1, string $part2): bool
{
    $checker = new MergedStringChecker($s, $part1, $part2);
    return $checker->check($checker->full, $checker->part1, $checker->part2);
}

class MergedStringCheckerTest extends TestCase
{
    public function testSampleTestCase(): void
    {
        $this->assertSame(true, isMerge('', '', ''));
        $this->assertSame(true, isMerge('Bananas from Bahamas', 'Bahas', 'Bananas from am'));
        $this->assertSame(true, isMerge('codewars', 'codewars', ''));
        $this->assertSame(false, isMerge('codewars', 'code', 'warss'));
        $this->assertSame(true, isMerge('codewars', 'code', 'wars'));
        $this->assertSame(true, isMerge('codewars', 'cdw', 'oears'));
        $this->assertSame(false, isMerge('codewars', 'cod', 'wars'));
    }
}
