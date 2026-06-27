<?php

declare(strict_types=1);

namespace Y2026\Q2;

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../Kata/Y2026/Q2/SoManyPermutations.php';
use function Kata\Y2026\Q2\permutations;

final class SoManyPermutationsTest extends TestCase
{
    private function assertEquivalent(array $expected, array $actual, string $msg = ''): void
    {
        sort($expected);
        sort($actual);
        $this->assertSame($expected, $actual, $msg);
    }
    public function testDescriptionExamples()
    {
        $this->assertEquivalent([''], permutations(''));
        $this->assertEquivalent(['aabb', 'abab', 'abba', 'baab', 'baba', 'bbaa'], permutations('aabb'));
        $this->assertEquivalent(['a'], permutations('a'));
        $this->assertEquivalent(['ab', 'ba'], permutations('ab'));
    }
}
